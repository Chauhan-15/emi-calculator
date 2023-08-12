<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- font --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        {{-- css --}}
        @vite('resources/css/app.css')
        
        <title>CALCULATOR</title>
    </head>
    <body>
        <div class="py-8 px-4 sm:px-8">
            @yield('content')
        </div>
    </body>
</html>
