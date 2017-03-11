@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])
        @section('scripts')
            <script>
                $('#flash-overlay-modal').modal();
            </script>
        @endsection
    @php session()->forget('flash_notification.overlay'); @endphp
    @else
        <div class="alert alert-{{ session('flash_notification.level') }} {{ session()->has('flash_notification.important') ? 'alert-important' : '' }}">
            <div class="container">
                @if(!session()->has('flash_notification.important'))
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" ><span aria-hidden="true">&times;</span></button>
                @endif

                {!! session('flash_notification.message') !!}
            </div>

        </div>
        @php session()->forget('flash_notification.message') @endphp
    @endif

@endif
