
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
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $("#gamers").select2({
            placeholder: "Выберите как минимум трех игроков",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection