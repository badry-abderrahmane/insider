<?php

namespace App\Http\Controllers;

use App\Services\League\Matchs;

class MatchsController
{

    /** Matchs $matchs */
    protected $matchs;

    public function __construct(Matchs $matchs)
    {
        $this->matchs = $matchs;
    }

    public function getMatchs()
    {
        return $this->matchs->getAllChampionshipMatchsByWeek();
    }
}
