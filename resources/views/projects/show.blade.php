<x-layouts.auth>
    <section class="max-w-5xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10">
            {{ $project->name }}
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                Informations du projet
            </h3>
            <ul class="space-y-4 text-gray-700">
                <li>
                    <p class="font-bold text-gray-900">Nom :</p>
                    <p>{{ $project->name }}</p>
                </li>
                <li>
                    <p class="font-bold text-gray-900">Description :</p>
                    <p>{{ $project->description ?? 'Aucune description' }}</p>
                </li>
            </ul>
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('projects.edit', $project) }}"
               class="p-2 hover:cursor-pointer w-fit bg-orange-400 text-white border transition-all border-orange-400 rounded-lg hover:bg-white hover:text-orange-400">
                Modifier ce projet
            </a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="p-2 w-fit bg-red-400 text-white border transition-all border-red-400 rounded-lg hover:bg-white hover:text-red-400">
                    Supprimer ce projet
                </button>
            </form>
        </div>
    </section>
</x-layouts.auth>
