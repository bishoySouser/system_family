<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        {{-- css --}}
        <link rel="stylesheet" href="css/app.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div id='app'>
            <!-- content -->
            @yield('content')
        </div>
        {{-- js --}}
        <script src="js/app.js" charset="utf-8"></script>

    </body>
</html>