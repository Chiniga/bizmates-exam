<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>What's the Weather?</title>
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <header></header>
        <div id="app">
            <weather-component></weather-component>
        </div>
        <footer></footer>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
