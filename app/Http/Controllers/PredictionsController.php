<?php

namespace App\Http\Controllers;

use App\Services\League\Predictions;
use Illuminate\Http\Request;

class PredictionsController
{

    /** Predictions $predictions */
    protected $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function getPredictions(Request $request)
    {
        $standings = $request->standings;
        return $this->predictions->getPredictionsByStandings($standings);
    }
}
