
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Создание записи')

@section('content')
    <h1 class="mt-1">Создание команды</h1>
    {!! Form::open(array('action' => array('TeamController@store'))) !!}
        @include('admin/teams/form')
    {!! Form::close() !!}


@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(".select2-single").select2({
            placeholder: "Выберите игрока",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection