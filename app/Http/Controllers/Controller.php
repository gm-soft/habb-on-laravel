<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Возвращает сгенерированное представление
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\Http\Response
     */
    protected function View($view = null, $data = [], $mergeData = []) {
        return view($view, $data, $mergeData);
    }

    /**
     * Генерит URL до дейсвтия контроллера
     *
     * @param  string  $name
     * @param  array   $parameters
     * @param  bool    $absolute
     * @return string
     */
    protected function Action($name, $parameters = [], $absolute = true)
    {
        return action($name, $parameters, $absolute);
    }

    /**
     * Возвращает JSON представление объекта
     *
     * @param string|array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function Json($data = array(), $status = 200, $headers = array(), $options = 0){
        return \Response::json($data, $status, $headers, $options);
    }
}
