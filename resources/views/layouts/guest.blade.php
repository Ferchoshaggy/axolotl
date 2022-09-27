<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AXOLOTL</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        
        <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
    </head>
    <div id="particles-js" style="width: 100%; height: 100vh; position: fixed; z-index: -1;"></div>
    <body class="font-sans antialiased" style="background: #24252a" >
        {{ $slot }}
    </body>
</html>

<script src="js/particles.min.js"></script>
<script src="js/activar.js"></script>