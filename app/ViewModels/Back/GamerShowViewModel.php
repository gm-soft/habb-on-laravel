<?php
namespace App\ViewModels\Back;



use App\Models\Team;

class GamerShowViewModel
{
    /** @var  \App\Models\Gamer */
    public $gamer;

    /** @var Team[] */
    public $teams;

    /** @var int */
    public $teamsCount;
}