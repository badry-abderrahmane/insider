<?php

namespace App\Services\League;

class Rules
{
    public function getTotalWeeks(Int $numberOfTeams)
    {
        return ($numberOfTeams - 1) * 2;
    }

    public function getMatchs(array $teams)
    {
        $permutatedPlayers = $this->permutations(array_keys($teams));

        $matchs = [];

        foreach ($permutatedPlayers as $key => $permutatedPlayer) {
            $players = explode(",", $permutatedPlayer);

            array_push($matchs, [
                $players[0],
                $players[1],
            ]);

            array_push($matchs, [
                $players[2],
                $players[3],
            ]);
        }

        return array_values(array_unique($matchs, SORT_REGULAR));
    }

    function permutations($array)
    {
        $list = array();

        $array_count = count($array);

        $number_of_permutations = 1;
        if ($array_count > 1) {
            for ($i = 1; $i <= $array_count; $i++) {
                $number_of_permutations *= $i;
            }
        }

        for ($i = 0; count($list) < $number_of_permutations; $i++) {
            shuffle($array);
            $tmp = implode(',', $array);
            if (!isset($list[$tmp])) {
                $list[$tmp] = 1;
            }
        }

        ksort($list);
        $list = array_keys($list);
        return $list;
    }
}
