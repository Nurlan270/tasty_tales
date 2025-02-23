<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    @stack('libs')

    <title>
        @if(Route::is('main') || empty($title))
            {{ config('app.name') }}
        @else
            {{ $title . ' - ' . config('app.name') }}
        @endif
    </title>
</head>
    <body>
        {{ $slot }}

    @stack('scripts')
    </body>
</html>
