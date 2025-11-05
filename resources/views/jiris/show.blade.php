@php use App\Enums\ContactRoles;use Carbon\Carbon; @endphp

<x-layouts.auth>
    <section class="max-w-5xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10">
            {{ $jiri->name }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Informations du Jiri
                </h3>
                <ul class="space-y-4 text-gray-700">
                    <li>
                        <p class="font-bold text-gray-900">Nom :</p>
                        <p>{{ $jiri->name }}</p>
                    </li>
                    <li>
                        <p class="font-bold text-gray-900">Description :</p>
                        <p>{{ $jiri->description ?? 'Aucune description' }}</p>
                    </li>
                    <li>
                        <p class="font-bold text-gray-900">Date :</p>
                        <p>{{ Carbon::parse($jiri->date)->format('d/m/Y') }}</p>
                    </li>
                </ul>
            </section>

            <aside class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Participation et devoirs
                </h3>

                <section class="mb-8">
                    <h4 class="text-xl font-semibold text-blue-500 mb-4 flex items-center gap-2">
                        Participants
                    </h4>
                    @if($jiri->contacts->isNotEmpty())
                        <ul class="space-y-3">
                            @foreach($jiri->contacts as $contact)
                                @php
                                    $attendance = $jiri->attendances()->where('contact_id', $contact->id)->first();
                                @endphp
                                <li class="flex justify-between items-center bg-white border border-gray-200 rounded-lg px-4 py-2 hover:shadow transition">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $contact->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $contact->email }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-sm rounded-full
                                        {{ $attendance && $attendance->role === ContactRoles::Evaluators ? 'bg-green-100 text-green-700' :
                                           ($attendance && $attendance->role === ContactRoles::Evaluated ? 'bg-blue-100 text-blue-700' :
                                           'bg-gray-100 text-gray-600') }}">
                                        {{ $attendance->role ?? 'Non défini' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm italic">Aucun participant enregistré.</p>
                    @endif
                </section>

                <section>
                    <h4 class="text-xl font-semibold text-blue-500 mb-4 flex items-center gap-2">
                        Projets
                    </h4>
                    @if($jiri->projects->isNotEmpty())
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($jiri->projects as $project)
                                <li class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow transition">
                                    <p class="font-semibold text-gray-800">{{ $project->name }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm italic">Aucun projet lié à ce Jiri.</p>
                    @endif
                </section>
            </aside>
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('jiris.edit', $jiri) }}"
               class="p-2 hover:cursor-pointer w-fit bg-orange-400 text-white border transition-all border-orange-400 rounded-lg hover:bg-white hover:text-orange-400">
                Modifier ce Jiri
            </a>
            <form action="{{ route('jiris.destroy', $jiri) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="p-2 w-fit bg-red-400 text-white border transition-all border-red-400 rounded-lg hover:bg-white hover:text-red-400">
                    Supprimer ce Jiri
                </button>
            </form>

        </div>
    </section>
</x-layouts.auth>
