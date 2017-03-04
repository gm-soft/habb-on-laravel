
@extends(\App\Helpers\Constants::BackLayoutPath)
@section('title', 'Создание записи')

@section('content')
    <h1 class="mt-1">Создание записи</h1>
    <div class="">

        <form method="post" action="{{ url('/admin/gamers/store') }}">
            @include('admin/gamers/form')
        </form>
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