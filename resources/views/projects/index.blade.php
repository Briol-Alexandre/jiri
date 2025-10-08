<x-layouts.auth>
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
</x-layouts.auth>
