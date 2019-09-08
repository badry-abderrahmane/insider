<div class="card">
    <div class="card-header">4th Week Predictions of Championship</div>

    <div class="card-body">
        <table id="league_predictions" class="table table-striped">
            <tbody>
               
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
    
        function getPredictions() {
            
            $.ajax({
                url : `predictions`,
                type : 'post',
                dataType : 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    standings : window.leagueTable
                },

                success : function(response){
                    $('#league_predictions > tbody').html('');
                    jQuery.each(response, function(team, percentage) {
                        percentage = parseInt(percentage);
                        $('#league_predictions > tbody').prepend(`
                            <tr>
                                <td>${team}</td>
                                <th scope="row">${percentage}%</th>
                            </tr>`
                        );
                    });
                },

                error : function(resultat, statut, erreur){
                    alert('Can not get predictions!')
                }

            });
        }

    </script>
@endpush