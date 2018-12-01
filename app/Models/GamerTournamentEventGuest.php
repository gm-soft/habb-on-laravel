<?php

namespace App\Models;

use DB;

/**
 * Class GamerTournamentEventGuest
 * Представление Many-to-Many, чтобы иметь возможность получить некоторую мета-инфу о регистрациях игроков на ивент
 *
 * @property int gamer_id
 * @property int tournament_id
 * @property int link_shares_count
 *
 * @package App\Models
 */
class GamerTournamentEventGuest
{
    const Gamers_EventGuests_ManyToManyTableName = "gamers_event_guests";

    /** @var int */
    public $gamer_id;

    /** @var int */
    public $tournament_id;

    /** @var int */
    public $link_shares_count;

    /**
     * @param $tournamentId
     * @return GamerTournamentEventGuest[]
     */
    public static function getAllByTournament($tournamentId) {

        $rows = DB::table(self::Gamers_EventGuests_ManyToManyTableName)
            ->where('tournament_id', '=', $tournamentId)
            ->get();

        $result = [];
        foreach ($rows as $row){
            $result[] = self::createFromRow($row);
        }

        return $result;
    }

    /**
     * @param int $habbId
     * @param GamerTournamentEventGuest[] $collection
     * @return int
     */
    public static function getLinkShareCountOfGamerInsideCollection($habbId, $collection){

        foreach ($collection as $item){
            if ($item->gamer_id == $habbId)
                return $item->link_shares_count;
        }

        return null;
    }


    /**
     * @param int $habbId
     * @param int $tournamentId
     * @return GamerTournamentEventGuest|null
     */
    public static function findByGamerAndTournament($habbId, $tournamentId)
    {
        $row = self::getQuery($habbId, $tournamentId)->first();

        if (is_null($row)){
            return null;
        }

        return self::createFromRow($row);
    }

    /**
     * @param \Eloquent $row
     * @return GamerTournamentEventGuest
     */
    private static function createFromRow($row, $asObject = true){
        $self = new self;

        $self->gamer_id = $row->gamer_id;
        $self->tournament_id = $row->tournament_id;
        $self->link_shares_count = $row->link_shares_count;

        return $self;
    }

    /**
     * @param int $habbId
     * @param int $tournamentId
     */
    public static function incrementLinkSharedCount($habbId, $tournamentId){

        self::getQuery($habbId, $tournamentId)
            ->update(['link_shares_count' => DB::raw('link_shares_count + 1')]);
    }

    /**
     * @param int $habbId
     * @param int $tournamentId
     * @return \Illuminate\Database\Query\Builder
     */
    private static function getQuery($habbId, $tournamentId){
        return DB::table(self::Gamers_EventGuests_ManyToManyTableName)
            ->where([
                ['gamer_id', '=', $habbId],
                ['tournament_id', '=', $tournamentId]
            ]);
    }
}
