
@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('uikit.flash.modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])
        @section('scripts')
            <script>
                $(document).ready(function () {
                    UIkit.modal('#modal').show();
                });
            </script>
        @endsection

        @php
            session()->forget('flash_notification.overlay');
            session()->forget('flash_notification.message');
        @endphp
    @else
        <div class="uk-container">
            <div class="uk-alert-{{ session('flash_notification.level') }}" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{!! session('flash_notification.message') !!}</p>

            </div>
        </div>

        @php session()->forget('flash_notification.message') @endphp
    @endif

@endif
