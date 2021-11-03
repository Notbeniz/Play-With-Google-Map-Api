<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Google Map</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/master.css')}}">
    </head>
    <body>
        <div class="container-fluid">
            <header>
                <x-nav></x-nav>
            </header>
            <x-message></x-message> 
            {{$slot}}
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
