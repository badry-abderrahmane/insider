<?php

namespace App\Services\League;


class Teams
{

    protected $TEAMS = [
        [
            "name" => "Liverpool",
            "strength" => 10
        ],
        [
            "name" => "Manchester City",
            "strength" => 10
        ],
        [
            "name" => "Leicester City",
            "strength" => 6
        ],
        [
            "name" => "Cristal Palace",
            "strength" => 4
        ]
    ];


    public function getNames()
    {
        return array_map(function ($team) {
            return $team["name"];
        }, $this->TEAMS);
    }

    public function getTeamStrength(String $name)
    {
        $team = array_filter(
            $this->TEAMS,
            function ($team) use ($name) {
                if ($team["name"] != $name) {
                    return false;
                }
                return true;
            }
        );

        if (count($team) < 1) {
            return 'No team with this name';
        }

        return reset($team)["strength"];
    }

    public function compareTeams(String $teamOne, String $teamTwo)
    {
        if ($this->getTeamStrength($teamOne) > $this->getTeamStrength($teamTwo)) {
            return $teamOne;
        }

        return $teamTwo;
    }
}
