<?php

namespace App\Http\Controllers;

use App\Services\League\Results;
use Illuminate\Http\Request;

class ResultsController
{

    /** Results $results */
    protected $results;

    public function __construct(Results $results)
    {
        $this->results = $results;
    }

    public function getResultsOfWeek(Request $request)
    {
        $matchs = $request->matchs;

        return $this->results->getWeekResults($matchs);
    }
}
