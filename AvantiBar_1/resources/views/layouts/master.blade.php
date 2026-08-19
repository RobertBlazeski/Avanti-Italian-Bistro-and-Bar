<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>Avanti Home Page</title>
        <link rel="stylesheet" href="{{ asset('css/spec_styles.css') }}">

    </head>
    <body>
        @include('nav')
        
        @yield('content')
        
        @include('footer')
    </body>
</html>