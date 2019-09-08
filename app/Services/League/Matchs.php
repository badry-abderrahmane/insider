<?php

namespace App\Services\League;

use App\Services\League\Teams;
use App\Services\League\Rules;

class Matchs
{
    /** Teams $teams */
    protected $teams;

    /** Rules $rules */
    protected $rules;

    public function __construct(Teams $teams, Rules $rules)
    {
        $this->teams = $teams;
        $this->rules = $rules;
    }

    public function getAllChampionshipMatchsByWeek()
    {
        $teams  = $this->teams->getNames();
        $matchs = $this->rules->getMatchs($teams);

        $champ = [];

        for ($week = 1; $week <= 6; $week++) {

            $champ[$week] = [];

            $firstTeams = $matchs[0];
            array_push($champ[$week], [
                $firstTeams[0],
                $firstTeams[1]
            ]);
            unset($matchs[0]);

            $matchs = array_values($matchs);

            $i = 0;
            while (count($champ[$week]) < 2) {
                if (!in_array($firstTeams[0], $matchs[$i]) && !in_array($firstTeams[1], $matchs[$i])) {
                    $secondTeams = $matchs[$i];

                    array_push($champ[$week], [
                        $secondTeams[0],
                        $secondTeams[1]
                    ]);
                    unset($matchs[$i]);

                    $matchs = array_values($matchs);
                }
                $i++;
            }
        }

        foreach ($champ as $w => $week) {
            foreach ($week as $m => $match) {
                foreach ($match as $p => $player) {
                    $champ[$w][$m][$p] = $teams[$player];
                }
            }
        }

        return $champ;
    }
}
