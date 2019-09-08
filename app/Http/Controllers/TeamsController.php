<?php

namespace App\Http\Controllers;

use App\Services\League\Teams;

class TeamsController
{

    /** Teams $teams */
    protected $teams;

    public function __construct(Teams $teams)
    {
        $this->teams = $teams;
    }

    public function getAllTeams()
    {
        return $this->teams->getNames();
    }
}
