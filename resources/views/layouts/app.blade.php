<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Company Management') }}</title>

    @include('layouts.partials.scripts')
    @include('layouts.partials.styles')
</head>
<body>
    <div id="app">
        @include('layouts.partials.navbar')
        @auth
            @include('layouts.partials.sidebar')
        @endauth
        <main id="main" class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.partials.footer')
</body>
</html>
