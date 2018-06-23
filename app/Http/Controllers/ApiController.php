<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\HttpStatuses;
use App\Models\ExternalService;
use App\Models\Gamer;
use App\Models\GamerScore;
use App\Traits\GamerConstructor;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;

class ApiController extends Controller
{
    use GamerConstructor;

    public function createGamer(Request $request){

        $apiKey = $request["api_key"];

        if (!isset($apiKey)){
            return response()->json([
                "result" => false,
                "message" => "Не указан ключ идентификации клиента API"
            ], HttpStatuses::AuthorizeRequired);
        }

        $externalService = ExternalService::findByApiKey($apiKey);

        if (!isset($externalService)){
            return response()->json([
                "result" => false,
                "message" => "Прислан невалидный ключ аутентификации"
            ], HttpStatuses::AuthorizeRequired);
        }

        $input = $request->all();
        $validator = Validator::make($input, Gamer::getApiRules());

        if ($validator->fails()) {
            return response()->json([
                "result" => false,
                "message" => "Ошибка при первичной валидации входных данных",
                "errors" => $validator->errors()->jsonSerialize()
            ], HttpStatuses::NotValidData);
        }

        $existingGamer = Gamer::getGamerFoundByEmailAndPhone($input["phone"], $input["email"]);
        if (!is_null($existingGamer)) {
            return response()->json([
                "result" => false,
                "message" => "Аккаунт с переданными телефоном или email уже существует в базе"
            ], HttpStatuses::NotValidData);
        }

        $gamer = $this->constructGamerInstanceWithRequiredOnly($request->all());
        $gamer->external_service_id = 1;

        if ($gamer->save())
        {
            $scores = GamerScore::getScoreSet();
            $gamer->scores()->saveMany($scores);

            return response()->json([
                "result" => true,
                "gamer" =>$gamer->jsonSerialize()
            ]);
        }

        return response()->json([
            "result" => false,
            "message" => "Ошибка при сохранении в базу",
            "errors" => $gamer->errors()->jsonSerialize()
        ], HttpStatuses::NotValidData);
    }

    public function doesGamerExists(Request $request){
        $apiKey = $request["api_key"];

        if (!isset($apiKey)){
            return response()->json([
                "result" => false,
                "message" => "Не указан ключ идентификации клиента API"
            ], HttpStatuses::AuthorizeRequired);
        }

        $externalService = ExternalService::findByApiKey($apiKey);

        if (!isset($externalService)){
            return response()->json([
                "result" => false,
                "message" => "Прислан невалидный ключ аутентификации"
            ], HttpStatuses::AuthorizeRequired);
        }

        $phone = $request->get('phone');
        $email = $request->get('email');

        if (!isset($phone) && !isset($email)){
            return response()->json([
                "result" => false,
                "message" => "Не указаны телефон и email. Поиск аккаунта осуществляется либо по телефону (поле phone), либо email (поле email)"
            ], HttpStatuses::NotValidData);
        }

        $gamer = Gamer::getGamerFoundByEmailAndPhone($phone, $email);

        if (!is_null($gamer)){
            return response()->json([
                "result" => true,
                "gamer" => "Пользователь найден",
                "habb_id" => $gamer->id
            ], HttpStatuses::Ok);
        }

        return response()->json([
            "result" => false,
            "message" => "Пользователь по указанным данным не найден"
        ], HttpStatuses::NotFound);
    }

    public function getGamer($id){

        if (!env(Constants::APP_DEBUG)){
            abort(HttpStatuses::NotFound);
        }

        /** @var Gamer $gamer */
        $gamer = Gamer::find($id);

        if (!isset($gamer))
        {
            return response()->json([
                'error' => "Объекта не существует"
            ], HttpStatuses::NotFound);
        }

        return response()->json($gamer->jsonSerialize());
    }


}
