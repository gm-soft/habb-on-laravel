<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:11 PM
 */

namespace App\Helpers;


use App\Models\Tournament;
use App\Traits\FrontDataTrait;
use App\ViewModels\Shared\Link;

class FrontDataFiller
{
    private $model;

    /** @var FrontDataTrait $frontModel */
    public function __construct($frontModel)
    {
        $this->model = $frontModel;
    }

    /**
     * @return void
     */
    public function fill()
    {
        $attachedTournaments = Tournament::getAttachedToNavIds(2)->toArray();

        $this->model->attached_tournaments_links = [];

        foreach ($attachedTournaments as $tournament){
            $this->model->attached_tournaments_links[] = Link::create(action('HomeController@openTournament', ['id' => $tournament->id]), $tournament->name);
        }
    }

    /** @var FrontDataTrait $frontModel
     * @return FrontDataFiller
     */
    public static function create($frontModel){
        return new FrontDataFiller($frontModel);
    }
}