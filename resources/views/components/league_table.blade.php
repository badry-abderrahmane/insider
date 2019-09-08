<div class="card">
    <div class="card-header">League Table</div>
    <div class="card-body">
        <table id="league_table" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Teams</th>
                    <th scope="col">PTS</th>
                    <th scope="col">P</th>
                    <th scope="col">W</th>
                    <th scope="col">D</th>
                    <th scope="col">L</th>
                    <th scope="col">GD</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="float-right">
            <button onclick="playAllWeeks()" class="btn btn-secondary">Play All</button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            window.automatic = false,
            getTeams();
            getMatchsByWeek();
        });
        
        function getTeams() {
            $.ajax({
                url : 'teams',
                type : 'GET',
                dataType : 'json',
                success : function(response){
                    window.teams = response;
                    window.leagueTable = [];
                    jQuery.each(response, function(key, team) {
                        leagueTable[key] = {
                            name: team,
                            pts : 0,
                            p   : 0,
                            w   : 0,
                            d   : 0,
                            l   : 0,
                            gd  : 0,
                            goals: 0
                        };
                        team = leagueTable[key]
                        $('#league_table > tbody').append(`
                            <tr id="team-${key}">
                                <th scope="row">${team.name}</th>
                                <td id="pts-${key}">${team.pts}</td>
                                <td id="p-${key}">${team.p}</td>
                                <td id="w-${key}">${team.w}</td>
                                <td id="d-${key}">${team.d}</td>
                                <td id="l-${key}">${team.l}</td>
                                <td id="gd-${key}">${team.gd}</td>
                            </tr>
                        `);
                    });
                },

                error : function(resultat, statut, erreur){
                    alert('Can not get teams!')
                }

            });
        }

        function getMatchsByWeek() {
            $.ajax({
                url : 'matchs',
                type : 'GET',
                dataType : 'json',
                success : function(response){
                    window.weeks = response;
                },

                error : function(resultat, statut, erreur){
                    alert('Can not get weeks!')
                }

            });
        }

        function refreshLeagueTable() {
            $('#league_table > tbody').html('');
            jQuery.each(window.leagueTable, function(key, team) {
                $('#league_table > tbody').append(`
                    <tr id="team-${key}">
                        <th scope="row">${team.name}</th>
                        <td id="pts-${key}">${team.pts}</td>
                        <td id="p-${key}">${team.p}</td>
                        <td id="w-${key}">${team.w}</td>
                        <td id="d-${key}">${team.d}</td>
                        <td id="l-${key}">${team.l}</td>
                        <td id="gd-${key}">${team.gd}</td>
                    </tr>
                `);
            });
        }

        function playAllWeeks() {
            window.automatic = true;
            getNextWeekResults()
        }
    </script>
@endpush