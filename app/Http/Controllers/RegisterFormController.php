<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\FrontDataFiller;
use App\Helpers\MiscUtils;
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

            if (MiscUtils::getLocalDatetimeNow()->gt($tournament->event_date)){
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

        $captainId = Input::get(Team::Captain_ForeignColumn);

        $secondId = Input::get(Team::SecondGamer_ForeignColumn);

        $thirdId = Input::get(Team::ThirdGamer_ForeignColumn);

        $forthId = Input::get(Team::ForthGamer_ForeignColumn);

        $fifthId = Input::get(Team::FifthGamer_ForeignColumn);

        $optionalId = Input::get(Team::OptionalGamer_ForeignColumn);

        $tournamentId = Input::get('t');

        $captainMobilePhone = Input::get('captain_phone');

        if (isset($tournamentId)){

            /** @var Tournament $tournament */
            $tournament = Tournament::findOrFail($tournamentId);

            if (MiscUtils::getLocalDatetimeNow()->gt($tournament->event_date)){

                // если дата ивента уже прошла, то и нечего регаться на нее
                flash('Турнир завершен, регистрация на него закрыта', Constants::Error);

                return Redirect::action('HomeController@openTournament', ['id' => $tournamentId]);
            }

        } else {

            flash('Не выбран турнир для регистрации', Constants::Error);
            return Redirect::action('HomeController@index');
        }

        $returnRedirectErrorResult = Redirect::action('RegisterFormController@teamRegisterForTournament', ['t' => $tournamentId])
            ->withInput(Input::all());

        // Проверим, что теелфон указали
        if (!isset($captainMobilePhone)){
            flash('Укажите номер телефона для связи', Constants::Error);
            return $returnRedirectErrorResult;
        }


        if (!$this->areUniqueIds($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId)){

            flash('Введите только уникальные значения HABB ID', Constants::Error);
            return $returnRedirectErrorResult;
        }

        $existingTeam = Team::findTeamByParticipants($captainId, $secondId, $thirdId, $forthId, $fifthId);

        if (isset($existingTeam)){

            $currentTournamentIds = $existingTeam->tournamentsIdsThatTakePart();

            $currentTournamentIds[] = $tournamentId;

            $currentTournamentIds = collect($currentTournamentIds)->unique()->values();

            $existingTeam->tournamentsThatTakePart()->sync($currentTournamentIds);

            //TODO не направлять сюда людей, когда у них уже есть команда
            flash("Команда с указанными участниками уже существует и зарегистрирована на этот турнир.".
                    "<br>Айди команды ".$existingTeam->id.", название ".$existingTeam->name, Constants::Success);

            return Redirect::action('HomeController@openTournament', ['id' => $tournamentId]);
        }

        if (!$this->doesAllGamersExists($captainId, $secondId, $thirdId, $forthId, $fifthId, $optionalId))
        {
            flash('Некоторые HABB ID не существуют. Проверьте верность введенных данных', Constants::Error);
            return $returnRedirectErrorResult;
        }

        $validator = Validator::make(Input::all(), Team::$rules);
        if ($validator->fails()) {

            flash('Ошибка валидации. Ошибок: '.$validator->errors()->count(), Constants::Error);
            return $this->returnRedirectResultWithErrors($tournamentId, $validator->errors());
        }

        // попытаемся актуализировать номер телефона капитана перед тем, как сохранить команду

        $captainMobilePhone = MiscUtils::formatPhone($captainMobilePhone);
        $gamer = Gamer::findByPhone($captainMobilePhone);

        if (is_null($gamer)){
            // если игрока нет, то точно переписываем номер телефона капитана
            /** @var Gamer $gamer */
            $gamer = Gamer::findOrFail($captainId);
            $gamer->phone = $captainMobilePhone;
            $gamerSaveResult = $gamer->save();

            if ($gamerSaveResult == false){
                flash('Не удалось обновить номер телефона капитана', Constants::Error);

                return $this->returnRedirectResultWithErrors($tournamentId, $validator->errors());
            }
        }
        else if ($gamer->id != $captainId){
            // если игрок найден, но его хабб айди принадлежит другому игроку, то выбрасываем ошибку
            flash('Указанный номер телефона принадлежит другому игроку. Укажите другой номер телефона для связи', Constants::Error);
            return $this->returnRedirectResultWithErrors($tournamentId, $validator->errors());
        }

        // сохраняем команду
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
            return $this->returnRedirectResultWithErrors($tournamentId, $team->errors());
        }

        $team->tournamentsThatTakePart()->attach([ $tournamentId ]);
        session(['team_id' => $team->id]);

        return Redirect::action('RegisterFormController@teamRegisterForTournamentResult');
    }

    /**
     * @param $tournamentId
     * @param $errors
     * @return \Illuminate\Http\RedirectResponse
     */
    private function returnRedirectResultWithErrors($tournamentId, $errors) {
        return Redirect::action('RegisterFormController@teamRegisterForTournament', ['t' => $tournamentId])
            ->withErrors($errors)
            ->withInput(Input::all());
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
