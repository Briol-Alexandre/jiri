@php use App\Enums\ContactRoles; @endphp

<x-layouts.auth>
    <section class="max-w-6xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10 text-center">
            {{ __('headings.create_a_jiri') }}
        </h2>

        <form action="{{ route('jiris.store') }}" method="POST" class="space-y-10">
            @csrf


            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
                    Informations du Jiri
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="name" class="font-semibold text-gray-700">
                            {{ __('labels/jiri.name') }} <small class="text-red-500">({{ __('labels/jiri.required') }})</small>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Ex: Jury de fin d’année">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="description" class="font-semibold text-gray-700">
                            Description
                        </label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Ex: Jury de présentation des projets">
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="font-semibold text-gray-700">
                            Date <small class="text-red-500">(requis)</small>
                        </label>
                        <input type="text" id="date" name="date" value="{{ old('date') }}"
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="2025-06-24 08:00:00">
                        @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>


            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Ajouter des contacts</h3>
                    <a href="{{ route('contacts.create') }}"
                       class="p-2 bg-blue-500 text-white rounded-md border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                        Créer un contact
                    </a>
                </div>

                @if($contacts->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($contacts as $contact)
                            <div class="flex justify-between items-center py-4">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" id="contact_{{ $contact->id }}" name="contacts[{{ $contact->id }}]" value="{{ $contact->id }}">
                                    <label for="contact_{{ $contact->id }}" class="flex flex-col">
                                        <span class="font-semibold text-gray-800">{{ $contact->name }}</span>
                                        <span class="text-sm text-gray-500">{{ $contact->email }}</span>
                                    </label>
                                </div>

                                <div>
                                    <label for="roles[{{ $contact->id }}]" class="text-sm text-gray-700">Rôle :</label>
                                    <select name="roles[{{ $contact->id }}]" id="roles[{{ $contact->id }}]"
                                            class="border-2 border-blue-400 rounded-md px-2 py-1 ml-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <option value="{{ ContactRoles::Evaluated }}">{{ ContactRoles::Evaluated->value }}</option>
                                        <option value="{{ ContactRoles::Evaluators }}">{{ ContactRoles::Evaluators->value }}</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-4">Aucun contact disponible pour le moment.</p>
                @endif
            </section>

            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Ajouter des projets</h3>
                    <a href="{{ route('projects.create') }}"
                       class="p-2 bg-blue-500 text-white rounded-md border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                        Créer un projet
                    </a>
                </div>

                @if($projects->count() > 0)
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($projects as $project)
                            <li class="flex items-center gap-3 bg-white border border-gray-200 rounded-lg p-3 hover:shadow transition">
                                <input type="checkbox" id="project_{{ $project->id }}" name="projects[{{ $project->id }}]" value="{{ $project->id }}">
                                <label for="project_{{ $project->id }}" class="flex flex-col">
                                    <span class="font-semibold text-gray-800">{{ $project->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $project->description }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic text-center py-4">Aucun projet disponible pour le moment.</p>
                @endif
            </section>


            <div class="flex justify-center">
                <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg border border-blue-500 hover:bg-white hover:text-blue-500 transition">
                    {{ __('labels/buttons.jiri-create') }}
                </button>
            </div>
        </form>
    </section>
</x-layouts.auth>
