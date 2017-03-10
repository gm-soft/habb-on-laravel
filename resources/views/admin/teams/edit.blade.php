
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
    <script type="text/javascript">
        $(".select2-multiple").select2({
            placeholder: "Иногда играю (можно выбрать несколько)",
        });

        $(".select2-single").select2({
            placeholder: "Играю активно",
        });

        $('#form').submit(function(){
            $("#submit-btn").prop('disabled',true);
        });
    </script>
@endsection