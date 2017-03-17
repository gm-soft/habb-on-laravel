<?php

namespace App\Mail;

use App\Models\Gamer;
use App\Models\Team;
use App\Models\TeamCreateRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamCreateRequestConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Team */
    private $team;
    /** @var TeamCreateRequest */
    private $teamCreateRequest;

    /** @var  Gamer[] */
    private $gamers;

    public function __construct(Team $team, TeamCreateRequest $teamCreateRequest, $gamers)
    {
        $this->team = $team;
        $this->teamCreateRequest = $teamCreateRequest;
        $this->gamers = $gamers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mails.team-create-confirmed')->with([
            'team'=>$this->team, 'request' => $this->teamCreateRequest, 'gamers' => $this->gamers
        ])/*->from('Сообщество Habb')*/;
    }
}
