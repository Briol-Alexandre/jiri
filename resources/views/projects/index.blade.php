<x-layouts.auth>
    <section class="max-w-5xl mx-auto bg-white rounded-2xl p-10 mt-10">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-10">
            Liste des Projets
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
            @if($projects->isNotEmpty())
                <ul class="space-y-3">
                    @foreach($projects as $project)
                        <li class="bg-white border border-gray-200 rounded-lg px-4 py-3 hover:shadow transition">
                            <a href="{{route('projects.show', $project)}}" class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">{!! $project->name !!}</p>
                                    @if($project->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $project->description }}</p>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-sm italic text-center">Aucun projet enregistré.</p>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{route('projects.create')}}" class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                Créer un projet
            </a>
        </div>
    </section>
</x-layouts.auth>
