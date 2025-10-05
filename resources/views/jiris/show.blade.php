<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <x-nav/>
        <section>
            <h2 class="text-2xl text-center font-bold text-blue-500 my-10">{!! $jiri->name !!}</h2>
            <div class="flex">
                <section class="w-1/2 text-center">
                    <h2 class="text-xl font-bold mb-5">Contacts</h2>
                    <table class="mx-auto w-1/2 text-left">
                        <thead>
                        <tr>
                            <th>
                                Contacts
                            </th>
                            <th>
                                Rôle
                            </th>
                        </tr>
                        </thead>
                        <tbody class=" divide-y-1 divide-gray-300">
                        @foreach($jiri->contacts as  $contact)
                            <tr class="text-left">
                                <td class="py-4">{{$contact->name}}</td>
                                <td>{{$jiri->attendances()->findOrFail($contact->id)->role}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <section class="w-1/2 text-center">
                    <h2 class="text-xl font-bold">Projets</h2>
                    <ul class="">
                        @foreach($jiri->projects as $project)
                            <li>
                                <p>{{$project->name}}</p>
                            </li>

                        @endforeach
                    </ul>
                </section>
            </div>
            <div class="flex justify-center">
                <a href="{{route('jiris.edit', $jiri)}}"
                   class="p-2 mt-5 bg-orange-400 hover:cursor-pointer text-center w-40 text-white border transition-all border-orange-400 rounded-md hover:bg-white hover:text-orange-400">
                    Modifier ce jiri
                </a>
            </div>
        </section>
    </body>
</html>
