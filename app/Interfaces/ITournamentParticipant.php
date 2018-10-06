<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 08.03.2017
 * Time: 8:58
 */

namespace App\Interfaces;


interface ITournamentParticipant
{
    public function getIdentifier();
    public function getName();
    public function getClass();
}