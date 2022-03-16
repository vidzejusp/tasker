<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--        <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">--}}
        <link href="{{ asset('load-awesome/line-scale.css') }}"

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
{{--        <script src="{{ asset('js/toastr.js') }}" defer></script>--}}
{{--        @livewireAssets--}}
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100" id="demo">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>


        </div>

{{--        @stack('modals')--}}
        <script src="https://cdn.tiny.cloud/1/qj2k503c4djogkv60opmbse8ac16kdgnuj1incali0l4d7oa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        @livewireScripts
        @livewire('livewire-ui-modal')

        <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
        <script>
            // navigator.geolocation.getCurrentPosition(sendPosition);
            // function sendPosition(position) {
            //     document.getElementById("demo").textContent = position.coords.latitude + "," + position.coords.longitude;
            //     alert(position.coords.latitude + "," + position.coords.longitude);
            // }
            // if(navigator.geolocation) navigator.geolocation.getCurrentPosition(function () {});
            window.livewire.on('getLocation', callback => {
                callback = callback.callback;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(sendPosition);
                    function sendPosition(position) {
                        livewire.emit(callback, { location : position.coords.latitude + "," + position.coords.longitude, } );
                    }
                } else {
                    livewire.emit(callback, { location : 'error', } );
                }
            });

            const beamsClient = new PusherPushNotifications.Client({
                instanceId: 'fdc27c1c-61e5-4ded-a85c-fbb31f42b2ec',
            });

            beamsClient.start()
                .then(() => beamsClient.addDeviceInterest('App.User.{{ auth()->user()->id }}')) //listen to user interest

            // tinymce.init({
            //     selector: 'textarea',
            //     plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            //     toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            //     toolbar_mode: 'floating',
            // });
        </script>

    </body>
</html>
