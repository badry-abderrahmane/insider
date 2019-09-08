<?php

namespace App\Services\League;

use App\Services\League\Rules;

class Predictions
{
    /** Rules $rules */
    protected $rules;

    public function __construct(Rules $rules)
    {
        $this->rules = $rules;
    }

    public function getPredictionsByStandings(array $standings)
    {
        usort($standings, function ($a, $b) {
            if ($a['pts'] == $b['pts']) return 0;
            return $a['pts'] < $b['pts'] ? 1 : -1;
        });

        $maxPTS = max(array_column($standings, 'pts'));

        $duplicatesOnPTS = $this->searchForDuplicates("pts", $standings, $maxPTS);

        if (count($duplicatesOnPTS) > 1) {

            $maxGD  = max(array_column($duplicatesOnPTS, 'gd'));

            $duplicatesOnGD = $this->searchForDuplicates("gd", $duplicatesOnPTS, $maxGD);
            if (count($duplicatesOnGD) > 1) {

                $maxGoals  = max(array_column($duplicatesOnGD, 'goals'));
                $duplicatesOnGoals = $this->searchForDuplicates("goals", $duplicatesOnGD, $maxGoals);
                $winnerPoints = $duplicatesOnGoals[0]['pts'] + 1;
                $standings = array_map(function ($standing) use ($duplicatesOnGoals) {
                    if ($standing["name"] === $duplicatesOnGoals[0]["name"]) {
                        $standing["pts"] += 1;
                    }
                    return $standing;
                }, $standings);
            } else {
                $winnerPoints = $duplicatesOnGD[0]['pts'] + 1;
                $standings = array_map(function ($standing) use ($duplicatesOnGD) {
                    if ($standing["name"] === $duplicatesOnGD[0]["name"]) {
                        $standing["pts"] += 1;
                    }
                    return $standing;
                }, $standings);
            }
        } else {
            $winnerPoints = $duplicatesOnPTS[0]['pts'] + 1;
            $standings = array_map(function ($standing) use ($duplicatesOnPTS) {
                if ($standing["name"] === $duplicatesOnPTS[0]["name"]) {
                    $standing["pts"] += 1;
                }
                return $standing;
            }, $standings);
        }

        $predictions = $this->getPredictionPoucentages($winnerPoints, $standings);

        return $predictions;
    }

    public function getPredictionPoucentages(int $winnerPoints, array $standings)
    {

        $predictions = [];

        foreach ($standings as $key => $player) {
            $predictions[$player["name"]] = ($player['pts'] * 100) / $winnerPoints;
        }

        return $predictions;
    }

    function searchForDuplicates($record, $standings, $value)
    {
        $duplicates = [];
        foreach ($standings as $key => $standing) {
            if ($standing[$record] == $value) {
                array_push($duplicates, $standing);
            }
        }
        return $duplicates;
    }
}
