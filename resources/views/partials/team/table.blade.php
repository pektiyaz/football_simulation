<div class="col-md-6">
    <table class="table table-bordered">
        <thead class="table-light">
        <tr>
            <th colspan="7">League Table</th>
        </tr>
        <tr>
            <th>Teams</th>
            <th>PTS</th>
            <th>P</th>
            <th>W</th>
            <th>D</th>
            <th>L</th>
            <th>GD</th>
        </tr>
        </thead>
        <tbody>
        @each('partials.team.item', $data['teams'], 'team')
        </tbody>
    </table>



</div>
