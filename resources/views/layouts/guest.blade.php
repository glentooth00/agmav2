<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance

    @livewireStyles
</head>

<body class="bg-zinc-100">

    @yield('content')

    @livewireScripts

    @fluxScripts
</body>
</html>