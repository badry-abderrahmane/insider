<div class="card">
    <div class="card-header">Match Results</div>

    <div class="card-body text-center">
        <h5>
            Week :
            <span id="week-number">0</span>
            / Match Results
        </h5>
        <hr>
        <div id="week_results_holder">

        </div>
    </div>

    <div class="card-footer">
        <div class="float-right">
            <button onclick="getNextWeekResults()" class="btn btn-secondary">Next Week</button>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        window.week = 0;

        $(function() {

            
        });
        

        function getNextWeekResults() {
            if (window.week < Object.keys(window.weeks).length) {
                
                window.week++;
                $('#week-number').html(window.week);
                $('#week_results_holder').html('');
                
                $.ajax({
                    url : `results`,
                    type : 'post',
                    dataType : 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        matchs : window.weeks[window.week]
                    },

                    success : function(response){
                        jQuery.each(response, function(key, match) {
                            
                            let playerOne = Object.keys(match)[0];
                            let scorePlayerOne = match[playerOne];
                            
                            let playerTwo = Object.keys(match)[1];
                            let scorePlayerTwo = match[playerTwo];

                            setLeagueTable(playerOne,scorePlayerOne, playerTwo, scorePlayerTwo);

                            setWeekResults(playerOne,scorePlayerOne, playerTwo, scorePlayerTwo);
                        });

                       
                        if (window.week > 3) {
                            getPredictions()
                        }

                        if (window.automatic) {
                            getNextWeekResults()
                        }
                        
                        
                    },
    
                    error : function(resultat, statut, erreur){
                        alert('Can not get week results!')
                    }
    
                });

                
            } 
            
        }


        function setLeagueTable(playerOne,scorePlayerOne, playerTwo, scorePlayerTwo) {
            window.leagueTable.map((teamRecords, index) => {
                if (teamRecords.name === playerOne) {
                    window.leagueTable[index].p++;
                    window.leagueTable[index].goals++;
                    if (scorePlayerOne > scorePlayerTwo) {
                        window.leagueTable[index].w++;
                        window.leagueTable[index].pts = window.leagueTable[index].pts + 3;
                    } 
                    if (scorePlayerOne < scorePlayerTwo) {
                        window.leagueTable[index].l++;
                    } 
                    if (scorePlayerOne === scorePlayerTwo) {
                        window.leagueTable[index].d++;
                        window.leagueTable[index].pts = window.leagueTable[index].pts + 1;
                    }
                }

                if (teamRecords.name === playerTwo) {
                    window.leagueTable[index].p++;
                    window.leagueTable[index].goals++;
                    if (scorePlayerOne < scorePlayerTwo) {
                        window.leagueTable[index].w++;
                        window.leagueTable[index].pts = window.leagueTable[index].pts + 3;
                    } 
                    if (scorePlayerOne > scorePlayerTwo) {
                        window.leagueTable[index].l++;
                        
                    } 
                    if (scorePlayerOne === scorePlayerTwo) {
                        window.leagueTable[index].d++;
                        window.leagueTable[index].pts = window.leagueTable[index].pts + 1;
                    }
                    window.leagueTable[index].gd = window.leagueTable[index].w - window.leagueTable[index].l;
                }
            });

            refreshLeagueTable();
            
        }

        function setWeekResults(playerOne,scorePlayerOne, playerTwo, scorePlayerTwo) {
            $('#week_results_holder').prepend(
                `
                    <div class="match-result">
                    <div class="row">
                        <div class="col-md-5">
                                ${playerOne}
                            </div>
                            <div class="col-md-2">
                                ${scorePlayerOne} - ${scorePlayerTwo}
                            </div>
                            <div class="col-md-5">
                                ${playerTwo}
                            </div>
                        </div>
                    </div>
                `
            );
        }
    </script>

@endpush