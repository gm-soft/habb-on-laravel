<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11/9/18
 * Time: 8:15 PM
 */

namespace App\ViewModels\Back\Tournament;


use App\Models\Gamer;
use App\Models\Team;
use App\Models\Tournament;

class TournamentExportExcelViewModel
{
    /** @var Tournament $tournament */
    public $tournament;

    /** @var TeamParticipant[] $teamParticipants*/
    public $teamParticipants;
}

class TeamParticipant
{
    /** @var string $name */
    public $name;

    /** @var Gamer $captain */
    public $captain;

    /** @var Gamer */
    public $secondGamer;

    /** @var Gamer */
    public $thirdGamer;

    /** @var Gamer */
    public $forthGamer;

    /** @var Gamer */
    public $fifthGamer;

    /** @var Gamer */
    public $optionalGamer;
}