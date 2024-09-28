<div class="col-md-4">
    <table class="table table-bordered">
        <thead class="table-light">
        <tr>
            <th colspan="3">Match Results</th>
        </tr>
        <tr>
            <th colspan="3">{{ $data['week']  }}<sup>th</sup> Week Match Result</th>
        </tr>


        </thead>
        <tbody>
            @each('partials.match.item', $data['matches'], 'match')
        </tbody>
    </table>
</div>
