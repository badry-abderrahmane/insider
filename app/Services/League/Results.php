<?php

namespace App\Services\League;

use App\Services\League\Matchs;

class Results
{
    /** Matchs $matchs */
    protected $matchs;

    /** Teams $teams */
    protected $teams;

    public function __construct(Teams $teams, Matchs $matchs)
    {
        $this->teams = $teams;
        $this->matchs = $matchs;
    }

    public function getMatchResult($teamOne, $teamTwo)
    {
        $winner = $this->teams->compareTeams($teamOne, $teamTwo);
        $looser = $teamOne === $winner ? $teamTwo : $teamOne;

        $resultWinner = rand(1, 6);
        $resultLooser = ($resultWinner - 3) < 0 ? 0 : $resultWinner - rand(0, 3);

        return [
            $winner => $resultWinner,
            $looser => $resultLooser
        ];
    }

    public function getWeekResults($week)
    {
        $results = [];
        foreach ($week as $key => $match) {
            $results[$key] = $this->getMatchResult($match[0], $match[1]);
        }
        return $results;
    }
}
