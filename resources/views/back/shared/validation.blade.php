@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Упс!</strong> Обнаружились некоторые проблемы при вводе данных.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif