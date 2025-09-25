<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <h1 class="text-3xl text-center font-bold text-blue-500 mt-10">
            Jiri
        </h1>
        <nav class="flex justify-center gap-4 mt-5 underline text-blue-300">
            <h2 class="sr-only">Navigation principale</h2>
            <a class="hover:text-blue-500 transition-all" href="/jiris">Accéder aux Jiris</a>
            <a class="hover:text-blue-500 transition-all" href="/contacts">Accéder aux Contacts</a>
            <a class="hover:text-blue-500 transition-all" href="/projects">Accéder aux Projets</a>
        </nav>

    </body>
</html>
