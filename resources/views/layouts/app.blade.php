<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/quasar@2.0.3/dist/quasar.prod.css" rel="stylesheet" type="text/css">
    </head>
    <body id="app" class="container py-3">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </body>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/quasar@2.0.3/dist/quasar.umd.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar@2.0.3/dist/lang/es.umd.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar@2.0.3/dist/icon-set/fontawesome-v5.umd.prod.js"></script>
    <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>
</html>
