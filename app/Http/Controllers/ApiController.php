<?php

namespace App\Http\Controllers;

use App\Helpers\HttpStatuses;
use App\Models\Gamer;
use App\Traits\GamerConstructor;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use GamerConstructor;

    public function createGamer(Request $request){

        $apiKey = $request["api_key"];


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

        return response()->json($gamer->jsonSerialize(), HttpStatuses::Ok);
    }
}
