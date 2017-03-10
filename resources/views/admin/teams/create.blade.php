
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Создание записи')

@section('content')
    <h1 class="mt-1">Создание команды</h1>
    <div class="">
        {!! Form::open(array('action' => array('TeamController@store'))) !!}
            @include('admin/teams/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $("#gamers").select2({
            placeholder: "Выберите как минимум трех игроков",
        });
        $('select').on('select2:select', function (evt) {
            // Do something
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection