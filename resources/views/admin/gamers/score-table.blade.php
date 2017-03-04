
<div class="card">
    <div class="card-block">
        <h5 class="card-title">Очки</h5>
        <div class="card-text">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Игра</th>
                    <th>Очки</th>
                    <th>Прирост</th>
                    <th>За месяц</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($gamer->scores as $score)

                    @php( $monthChanged = $score->total_value - $score->month_value)
                    <tr>
                        <td>{{  $score->game_name }}</td>
                        <td>{{ $score->total_value }}</td>
                        <td>{{ $score->total_change }}</td>
                        <td>{{ $monthChanged }}</td>
                        <td></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>