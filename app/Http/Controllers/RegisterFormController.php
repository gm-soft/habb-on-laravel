<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\FrontDataFiller;
use App\Helpers\VarDumper;
use App\Models\Gamer;
use App\Models\Team;
use App\Models\Tournament;
use App\ViewModels\Front\RegisterForm\TeamRegisterResultViewModel;
use App\ViewModels\Front\TeamCreateRequest\RegisterTeamFormViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class RegisterFormController extends Controller
{
    public function teamRegisterForTournament(Request $request) {

        $tournamentId = Input::get('t');

        $tournament = null;
        $model = new RegisterTeamFormViewModel();

        if (isset($tournamentId)){

            /** @var Tournament $tournament */
            $tournament = Tournament::findOrFail($tournamentId);

            if ($tournament->event_date > Carbon::now()){
                // если дата ивента уже прошла, то и нечего регаться на нее
                flash('Турнир завершен, регистрация на него закрыта', Constants::Error);
                return \Redirect::back();
            }

            $model->tournamentName = $tournament->name;

        } else {

            flash('Выберите турнир для регистрации', Constants::Error);
            return \Redirect::back();
        }

        $model->tournamentId = $tournamentId;
        $model->cities = Constants::getCities();
        $model->emailPattern = Constants::EmailRegexPattern;

        FrontDataFiller::create($model)->fill();

        return view('front.register.teamRequest', ['model' => $model]);
    }

    public function saveTeamRegisterForTournament(Request $request) {

        // TODO implement
        $captainId = Input::get(Team::Captain_ForeignColumn);
        $secondId = Input::get(Team::SecondGamer_ForeignColumn);
        $thirdId = Input::get(Team::ThirdGamer_ForeignColumn);
        $forthId = Input::get(Team::ForthGamer_ForeignColumn);
        $fifthId = Input::get(Team::FifthGamer_ForeignColumn);
        $optionalId = Input::get(Team::OptionalGamer_ForeignColumn);

        $tournamentId = Input::get('t');

        $returnRedirectErrorResult = Redirect::action('RegisterFormController@teamRegisterForTournament', ['t' => $tournamentId])
            ->withInput(Input::all());


        if (!$this->areUniqueIds($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId)){

            flash('Введите только уникальные значения HABB ID', Constants::Error);
            return $returnRedirectErrorResult;
        }

        $existingTeam = Team::findTeamByParticipants($captainId, $secondId, $thirdId, $forthId, $fifthId);
        if (isset($existingTeam)){

            // TODO REDIRECT To error page
            flash('Команда с указанными участниками уже существует', Constants::Error);
            return $returnRedirectErrorResult;
        }

        if (!$this->doesAllGamersExists($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId))
        {
            // TODO ERROR
            flash('Некоторые HABB ID не существуют. Проверьте верность введенных данных', Constants::Error);
            return $returnRedirectErrorResult;
        }

        $validator = Validator::make(Input::all(), Team::$rules);
        if ($validator->fails()) {

            flash('Ошибка валидации. Ошибок: '.$validator->errors()->count(), Constants::Error);

            return Redirect::action('RegisterFormController@teamRegisterForTournament', ['t' => $tournamentId])
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }

        $team = new Team();
        $team->name = Input::get('name');
        $team->city = Input::get('city');
        $team->captain_gamer_id = $captainId;
        $team->second_gamer_id = $secondId;
        $team->third_gamer_id = $thirdId;
        $team->forth_gamer_id = $forthId;
        $team->fifth_gamer_id = $fifthId;
        $team->optional_gamer_id = $optionalId;

        $success = $team->save();

        if ($success == false) {

            flash('Ошибка при сохранении данных', Constants::Error);

            return Redirect::action('RegisterFormController@teamRegisterForTournament', ['t' => $tournamentId])
                ->withErrors($team->errors())
                ->withInput(Input::all());

        }

        $team->tournamentsThatTakePart()->sync([ $tournamentId ]);
        session(['team_id' => $team->id]);

        return Redirect::action('RegisterFormController@teamRegisterForTournamentResult');
    }

    /**
     * @param $captainId
     * @param $secondId
     * @param $thirdId
     * @param $forthId
     * @param $fifthId
     * @param $optionalId
     * @return bool
     */
    private function doesAllGamersExists($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId){

        $values = [$captainId, $secondId, $thirdId, $forthId, $fifthId];
        if (isset($optionalId))
            $values[] = $optionalId;

        $count = Gamer::query()
            ->whereIn('id', $values)
            ->count();

        return $count == count($values);
    }

    private function areUniqueIds($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId){
        $values = [$captainId, $secondId, $thirdId, $forthId, $fifthId];
        if (isset($optionalId))
            $values[] = $optionalId;



        return count($values) === collect($values)->unique()->count();
    }

    public function teamRegisterForTournamentResult(Request $request) {

        $id = $request->session()->get('team_id');

        if (is_null($id)) {
            // Если внезапно id нет, то редирект на страницу регистрации участника
            return Redirect::action('RegisterFormController@teamRegisterForTournament');
        }

        /** @var Team $team */
        $team = Team::findOrFail($id);
        $request->session()->forget('team_id');

        $model = new TeamRegisterResultViewModel();
        $model->team = $team;

        FrontDataFiller::create($model)->fill();

        return view('front.register.teamRequestResult', ['model' => $model]);
    }
}
