<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\HttpStatuses;
use App\Models\ExternalService;
use App\Models\Gamer;
use App\Models\GamerScore;
use App\Traits\GamerConstructor;
use Illuminate\Http\Request;
use Validator;

class ApiController extends Controller
{
    use GamerConstructor;

    public function createGamer(Request $request){

        //return response()->json(Gamer::getApiRules());

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

        if (Gamer::hasGamerFoundByEmailAndPhone($input["phone"], $input["email"])){
            return response()->json([
                "result" => false,
                "message" => "Аккаунт с переданными телефоном или email уже существует в базе",
                "errors" => $validator->errors()->jsonSerialize()
            ], HttpStatuses::NotValidData);
        }

        $gamer = $this->constructGamerInstance($request->all());
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

    public function getGamer($id){
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
