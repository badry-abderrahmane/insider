@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            @component('components.league_table')
                
            @endcomponent
        </div>
        <div class="col-md-5">
            @component('components.match_results')
                
            @endcomponent
        </div>
        
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            @component('components.championship_predictions')
                
            @endcomponent
        </div>
    </div>
</div>
@endsection
