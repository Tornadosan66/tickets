<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{asset('/bootstrap4/dist/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('/menu/style5.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/univer_log.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/univer_log.png') }}">
    <script src="{{asset('/js/jquery/jquery-3.3.1.slim.min.js')}}" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="{{asset('/js/popper/popper.min.js')}}" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('/bootstrap4/dist/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>

    <!-- Font Awesome JS -->
    <script defer src="{{asset('/fontawesome/js/all.js')}}" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

        <title>{{ config('app.name', 'Univer') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
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

        @stack('modals')

        @livewireScripts
    </body>
</html>
