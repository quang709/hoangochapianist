<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

     
        <!-- Fonts -->
       <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


 

        <link rel="stylesheet" href="{{ asset('app/css/app.css') }}">

<script src="{{ asset('app/js/app.js') }}" type="text/javascript"></script>
    </head>
    <body>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
