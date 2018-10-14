<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\FrontDataFiller;
use App\Models\Gamer;
use App\Models\Team;
use App\Models\TeamCreateRequest;
use App\Models\TeamScore;
use App\Traits\EmailSender;
use App\Traits\TeamConstructor;
use App\ViewModels\Front\TeamCreateRequest\RegisterTeamFormResultViewModel;
use App\ViewModels\Front\TeamCreateRequest\RegisterTeamFormViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class TeamCreateRequestController extends Controller
{
    use TeamConstructor, EmailSender;

    #region CRUD
    public function index(Request $request)
    {
        $instances = TeamCreateRequest::all();
        return view('admin.teamRequests.index', [
            "instances" => $instances,
        ]);
    }


    public function create()
    {
        $cities = Constants::getCities();
        $emailRegPattern = Constants::EmailRegexPattern;



        return view('admin.teamRequests.create',[
            'cities'=>$cities, 'emailRegPattern' => $emailRegPattern
            ]);
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, TeamCreateRequest::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamCreateRequestController@create')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        $instance = $this->constructTeamCreateRequest(null, Input::all());
        $success = $instance->save();
        if ($success == false) {
            return Redirect::action('TeamCreateRequestController@create')
                ->withErrors($instance->errors())
                ->withInput($input);

        }

        return Redirect::action('TeamCreateRequestController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {

        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);

        $gamers = [];

        for ($i = 0; $i < count($instance->participant_ids); $i++) {

            $participant_id = $instance->participant_ids[$i];
            $gamer = Gamer::find($participant_id);
            $gamers[$i] = $gamer ?? null;
        }
        return view('admin.teamRequests.show', [
            'instance' => $instance, 'gamers' => $gamers
        ]);
    }

    public function edit($id)
    {

        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);
        $cities = Constants::getCities();
        $emailRegPattern = Constants::EmailRegexPattern;

        return view('admin.teamRequests.edit', [
            'instance' => $instance, 'emailRegPattern' => $emailRegPattern, 'cities' => $cities
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $validator = Validator::make($input, TeamCreateRequest::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamCreateRequestController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }
        $instance = $this->constructTeamCreateRequest($id, Input::all());
        $res = $instance->update();

        if ($res === false) {
            return Redirect::action('TeamCreateRequestController@edit', ["id" => $instance->id])
                ->withErrors($instance->errors())
                ->withInput($input);
        }
        return Redirect::action('TeamCreateRequestController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id)
    {
        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);
        $result = $instance->delete();
        if ($result == true) {
            $message = "Запись ID".$instance->id." удалена из базы";
            $type = Constants::Success;
        } else {
            $message = "Запись ID".$instance->id." не удалена из базы<br>";
            $errors = $instance->errors();
            foreach ($errors as $error) {
                $message .= $error."<br>";
            }
            $type = Constants::Error;
        }
        flash($message, $type);
        return Redirect::action('TeamCreateRequestController@index');
    }
    #endregion

    #region Подтверждение и отклонение заявок
    /**
     * Если  менеджер утверждает заявку, то срабатывает этот экшн
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmRequest(Request $request) {
        $requestId = Input::get('request_id');
        $confirmMes = Input::get('confirm_message');

        /** @var TeamCreateRequest $teamCreateRequest */
        $teamCreateRequest = TeamCreateRequest::find($requestId);
        if ($teamCreateRequest->request_processed == true) {
            flash('Заявка уже обработана', Constants::Warning);
            return Redirect::action('TeamCreateRequestController@show', ['id' => $teamCreateRequest->id]);
        }

        $team = $this->createTeamFromCreateRequest($teamCreateRequest);
        $result = $team->save();

        if ($result == true) {
            $team->scores()->saveMany(TeamScore::getScoreSet());
            $teamCreateRequest->request_processed = true;
            $teamCreateRequest->team_created = true;
            $teamCreateRequest->team_id = $team->id;

            $teamCreateRequest->save();
            $gamers = $team->getGamers();

            $this->sendConfirmationEmail($team, $teamCreateRequest, $gamers);

            flash('Команда создана из заявки', Constants::Success);
            return Redirect::action('TeamController@show', ['id' => $team->id]);
        }
        flash('Команда не была создана из заявки', Constants::Error);
        return Redirect::action('TeamCreateRequestController@edit', ['id' => $team->id])
            ->withErrors($team->errors());
    }


    /**
     * Если менеджер отклоняет заявку, то срабатывает этот метод
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function denyRequest(Request $request) {
        $requestId = Input::get('request_id');
        $confirmMes = Input::get('deny_message');

        /** @var TeamCreateRequest $teamCreateRequest */
        $teamCreateRequest = TeamCreateRequest::find($requestId);

        if ($teamCreateRequest->request_processed == true) {
            flash('Заявка уже обработана', Constants::Warning);
            return Redirect::action('TeamCreateRequestController@show', ['id' => $teamCreateRequest->id]);
        }

        $teamCreateRequest->request_processed = true;
        $teamCreateRequest->team_created = false;
        $teamCreateRequest->team_id = null;
        $teamCreateRequest->save();

        $this->sendDenyEmail($confirmMes, $teamCreateRequest);

        flash('Заявка отклонена успешно с сообщением:<br>'.$confirmMes, Constants::Success);
        return Redirect::action('TeamCreateRequestController@show', ['id' => $teamCreateRequest->id]);

    }

    /**
     * Отправка емейла об утверждении заявки
     * @param Team $team
     * @param TeamCreateRequest $teamCreateRequest
     * @param array $gamers
     * @return bool
     */
    private function sendConfirmationEmail(Team $team, TeamCreateRequest $teamCreateRequest, array $gamers) {
        $viewString = view('mails.team-create-confirmed', ['request'=>$teamCreateRequest, 'team'=>$team, 'gamers'=>$gamers])->render();

        $to = $teamCreateRequest->requester_email;
        $subject = "Утверждение заявки на команду";
        return $this->sendEmail($subject, $viewString, $to);
    }

    /**
     * Отправка емейла об утверждении заявки
     * @param string $message
     * @param TeamCreateRequest $teamCreateRequest
     * @return bool
     */
    private function sendDenyEmail(string $message, TeamCreateRequest $teamCreateRequest) {
        // TODO реализовать
        $viewString = view('mails.team-create-deny', ['request'=>$teamCreateRequest, 'message'=>$message])->render();

        $to = $teamCreateRequest->requester_email;
        $subject = "Отказ в заявке на команду";
        return $this->sendEmail($subject, $viewString, $to);
    }
    #endregion

    public function registerTeamFormView() {
        $model = new RegisterTeamFormViewModel;
        $model->cities = Constants::getCities();
        $model->emailPattern = Constants::EmailRegexPattern;

        FrontDataFiller::create($model)->fill();

        return view('front.register.teamRequest', [ 'model' => $model ]);
    }

    public function registerTeamFormPost(Request $request) {

        $instance = $this->constructTeamCreateRequest(null, Input::all());
        $result = $instance->save();

        if ($result == false) {
            return Redirect::action('TeamCreateRequestController@registerTeamFormView')
                ->withErrors($instance->errors())
                ->withInput(Input::all());

        }
        session(['request_id' => $instance->id]);
        return Redirect::action('TeamCreateRequestController@registerTeamFromResult');

    }

    public function registerTeamFromResult(Request $request) {
        $id = $request->session()->get('request_id');
        if (is_null($id)) {

            flash('Возникла непредвиденная ошибка при сохранении заявки.<br>Заполните и отправьте, пожалуйста, еще раз. Извините за неудобство =(', Constants::Warning);
            return Redirect::action('TeamCreateRequestController@registerTeamFormView');
        }
        $teamRequest = TeamCreateRequest::find($id);
        $request->session()->forget('request_id');

        $model = new RegisterTeamFormResultViewModel();
        $model->team_request = $teamRequest;
        FrontDataFiller::create($model)->fill();

        return view('front.register.team-result', ['model' => $model]);
    }
}
