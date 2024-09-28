<div class="col-md-2">
    <table class="table table-bordered">
        <thead class="table-light">
        <tr>
            <th colspan="2">{{ $data['week']  }}<sup>th</sup> Week Prediction of Chempions</th>
        </tr>
        </thead>
        <tbody>
        @each('partials.prediction.item', $data['prediction'], 'prediction')
        </tbody>
    </table>

</div>
