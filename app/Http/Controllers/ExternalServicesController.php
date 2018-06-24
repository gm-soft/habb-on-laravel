<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\HttpStatuses;
use App\Helpers\MiscUtils;
use App\Models\ExternalService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class ExternalServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ExternalService::all();
        return view('admin.externalServices.index', [
            "externalServices" => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.externalServices.create');
    }

    public function store(Request $request)
    {
        $input = $request->input();

        $model = new ExternalService;

        $model-> title = Input::get('title');
        $model->comment = Input::get('comment');

        $model->api_key = MiscUtils::generateSha1RandomString();

        if (!$model->save()) {

            $errors = $model->errors();
            $this->flashErrors($errors);

            return Redirect::action('ExternalServicesController@create')
                ->withErrors($errors)
                ->withInput($input);
        }

        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('ExternalServicesController@show', ["id" => $model->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var ExternalService $model */
        $model = ExternalService::find($id);

        return view('admin.externalServices.show', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var ExternalService $model */
        $model = ExternalService::find($id);

        return view('admin.externalServices.edit', [
            'model' => $model,
        ]);
    }


    public function update(Request $request, $id)
    {
        /** @var ExternalService $model */
        $model = ExternalService::find($id);

        $input = $request->input();

        $model-> title = Input::get('title');
        $model->comment = Input::get('comment');

        if (!$model->save()) {
            $errors = $model->errors();
            $this->flashErrors($errors);

            return Redirect::action('ExternalServicesController@update')
                ->withErrors($errors)
                ->withInput($input);
        }

        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('ExternalServicesController@show', ["id" => $model->id]);
    }

    public function updateApiKey(Request $request){

        /** @var ExternalService $model */
        $model = ExternalService::find($request["id"]);

        if (!isset($model)){
            return response()->json([
                'error' => "Объекта не существует"
            ], HttpStatuses::NotFound);
        }

        $newApiKey = MiscUtils::generateSha1RandomString();
        $model->api_key = $newApiKey;

        if ($model->save())
            return response()->json([
                'api_key' => $newApiKey
            ], HttpStatuses::Ok);

        return response()->json([
            'error' => $model->errors()->jsonSerialize()
        ], HttpStatuses::ServerError);
    }

    public function destroy($id)
    {
        /** @var ExternalService $model */
        $model = ExternalService::find($id);

        $model->deleted_at = Carbon::now();
        $result = $model->save();

        if ($result == true) {
            flash("Запись ID".$model->id." удалена из базы", Constants::Success);
        }
        else {
            $this->flashErrors($model->errors(), "Запись ID".$model->id." не удалена из базы<br>");
        }

        return Redirect::action('ExternalServicesController@index');
    }

    private function flashErrors($errors, $seed = "Произошли ошибки: <br>"){
        $message = $seed;

        foreach ($errors as $error) {
            $message .= $error." <br>";
        }

        flash($message, Constants::Error);
    }
}
