@php use App\Models\Jiri;use App\Models\Project; @endphp

<x-layouts.auth>
    <section class="max-w-5xl mx-auto bg-white rounded-2xl p-10 mt-10">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-10">
            {{ $contact->name }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Informations du contact
                </h3>
                <div class="flex flex-col items-center mb-6">
                    <img src="{{asset('images/contacts/originals/'.$contact->avatar)}}" alt="image de {{$contact->name}}" class="w-32 aspect-square object-cover rounded-full mb-4">
                </div>
                <ul class="space-y-4 text-gray-700">
                    <li>
                        <p class="font-bold text-gray-900">{{__('labels/contact.name')}}</p>
                        <p>{{$contact->name}}</p>
                    </li>
                    <li>
                        <p class="font-bold text-gray-900">{{__('labels/contact.email')}}</p>
                        <p>{{$contact->email}}</p>
                    </li>
                </ul>
            </section>

            <aside class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Activités
                </h3>

                <section class="mb-8">
                    <h4 class="text-xl font-semibold text-blue-500 mb-4 flex items-center gap-2">
                        Participations
                    </h4>
                    @if($contact->attendances->isNotEmpty())
                        <ul class="space-y-3">
                            @foreach($contact->attendances as $attendance)
                                @php
                                    $jiri = Jiri::get()->where('id', $attendance->jiri_id)->first();
                                @endphp
                                <li class="bg-white border border-gray-200 rounded-lg px-4 py-2 hover:shadow transition">
                                    <p class="font-semibold text-gray-800">{{$jiri->name}}</p>
                                    <small class="text-sm text-gray-500">en tant qu'{{ $attendance->role }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm italic">Aucune participation enregistrée.</p>
                    @endif
                </section>

                <section>
                    <h4 class="text-xl font-semibold text-blue-500 mb-4 flex items-center gap-2">
                        Devoirs
                    </h4>
                    @if($contact->assignments->isNotEmpty())
                        <ul class="space-y-3">
                            @foreach($contact->assignments as $assignment)
                                @php
                                    $project = Project::get()->where('id', $assignment->project_id)->first();
                                @endphp
                                <li class="bg-white border border-gray-200 rounded-lg px-4 py-2 hover:shadow transition">
                                    <p class="font-semibold text-gray-800">{{$project->name}}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm italic">Aucun devoir assigné.</p>
                    @endif
                </section>
            </aside>
        </div>
    </section>
</x-layouts.auth>
