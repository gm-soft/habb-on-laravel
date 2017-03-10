
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Создание записи')

@section('content')
    <h1 class="mt-1">Создание записи</h1>
    <div class="">
        {!! Form::open(array('action' => array('GamerController@store'))) !!}
            @include('admin/gamers/form')
        {!! Form::close() !!}
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
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
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection