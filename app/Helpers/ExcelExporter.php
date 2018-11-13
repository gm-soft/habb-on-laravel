<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11/13/18
 * Time: 8:35 PM
 */

namespace App\Helpers;


class ExcelExporter
{
    /**
     * @param string $viewName
     * @param array $viewModel
     * @param string $fileName
     * @return ExcelExporter
     */
    public static function createInstance($viewName, $viewModel, $fileName){
        return new self($viewName, $viewModel, $fileName);
    }

    /** @var string */
    private $viewName;

    /** @var array */
    private $viewModel;

    /** @var string */
    private $fileName;

    /**
     * ExcelExporter constructor.
     * @param string $viewName
     * @param array $viewModel
     * @param string $fileName
     */
    public function __construct($viewName, $viewModel, $fileName)
    {
        $this->viewName = $viewName;
        $this->viewModel = $viewModel;
        $this->fileName = $fileName;
    }

    public function getResult(){

        // Выгрузка в файл взята отсюда https://stackoverflow.com/a/12541019

        $headers = [
            'Content-type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=$this->fileName"
        ];

        return response()->view($this->viewName, $this->viewModel, HttpStatuses::Ok, $headers);
    }
}