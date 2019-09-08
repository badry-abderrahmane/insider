<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/teams', 'TeamsController@getAllTeams')->name('teams');

Route::get('/matchs', 'MatchsController@getMatchs')->name('matchs');

Route::post('/results', 'ResultsController@getResultsOfWeek')->name('results');

Route::post('/predictions', 'PredictionsController@getPredictions')->name('predictions');




Route::get('/old', function (App\Services\League\Matchs $matchs) {
    return $matchs->getAllChampionshipMatchsByWeek();


    /* $pons = $Rules->permutations([1, 2, 3, 4]);

    $cols = [];

    foreach ($pons as $key => $pon) {
        $sps = explode(",", $pon);

        array_push($cols, [
            $sps[0],
            $sps[1],
        ]);

        array_push($cols, [
            $sps[2],
            $sps[3],
        ]);
    }

    $matchs = array_values(array_unique($cols, SORT_REGULAR));

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

    dd($champ); */
});
