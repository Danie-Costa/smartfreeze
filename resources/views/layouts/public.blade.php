<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @foreach ( $dadosEstruturados as $dadosEstruturado )
        <script type="application/ld+json">
            {!!  json_encode( $dadosEstruturado , JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endforeach
    

    {{-- <meta name="description" content=""> --}}

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    @yield('content')
</body>
</html>
