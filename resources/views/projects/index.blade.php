<!doctype html>
<html lang="en">
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
        <section class="px-4 gap-5 flex flex-col">
            <h2 class="text-xl font-bold">Liste des Projets</h2>
            <ul class="pl-5">
                @foreach($projects as $project)
                    <li>
                        <a href="{{route('projects.show', $project)}}" class="underline">
                            {!! $project->name !!}
                        </a>
                    </li>
                @endforeach
            </ul>

            <a href="{{route('projects.create')}}" class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">Créer un projet</a>
        </section>
    </body>
</html>
