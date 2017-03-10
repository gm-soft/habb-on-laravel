
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Редактирование команды')

@section('content')
    <h1 class="mt-1">Редактирование команды {{ $gamer->name }}</h1>
    <div class="">

        {!! Form::model($gamer, ['method' => 'put', 'action' => ['TeamController@update', $gamer->id]]) !!}
            @include('admin/teams/form')
        {!! Form::close() !!}

    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $("#gamer_ids").select2({
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