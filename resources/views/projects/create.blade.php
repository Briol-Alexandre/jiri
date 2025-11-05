@php use App\Enums\ContactRoles; @endphp

<x-layouts.auth>
    <section class="max-w-5xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10 text-center">
            {{ __('headings.create_a_project') }}
        </h2>

        <form action="{{ route('projects.store') }}" method="POST" class="space-y-10">
            @csrf

            {{-- Informations du projet --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Informations du projet
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nom --}}
                    <div>
                        <label for="name" class="font-semibold text-gray-700">
                            {{ __('labels/project.name') }}
                            <small class="text-red-500">({{ __('labels/project.required') }})</small>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Ex: Design Web 0626">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="font-semibold text-gray-700">
                            {{ __('labels/project.description') }}
                        </label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Ex: Projet d’application mobile avec Flutter">
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- Lier à un Jiri --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        {{ __('headings.link_a_jiri') }}
                    </h3>
                    <a href="{{ route('jiris.create') }}"
                       class="p-2 bg-blue-500 text-white rounded-md border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                        {{ __('labels/buttons.jiri-create') }}
                    </a>
                </div>

                @if($jiris->count() > 0)
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-64 overflow-y-auto pr-2">
                        @foreach($jiris as $jiri)
                            <li class="flex items-start gap-3 bg-white border border-gray-200 rounded-lg p-3 hover:shadow transition">
                                <input type="checkbox" id="jiri_{{ $jiri->id }}" name="jiris[{{ $jiri->id }}]" value="{{ $jiri->id }}">
                                <label for="jiri_{{ $jiri->id }}" class="flex flex-col">
                                    <span class="font-semibold text-gray-800">{{ $jiri->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $jiri->description ?? 'Aucune description' }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic text-center py-4">Aucun Jiri disponible pour le moment.</p>
                @endif
            </section>

            {{-- Bouton de validation --}}
            <div class="flex justify-center">
                <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                   Créer le projet
                </button>
            </div>
        </form>
    </section>
</x-layouts.auth>
