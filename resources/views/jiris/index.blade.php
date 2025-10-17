<x-layouts.auth>
    <section class="max-w-5xl mx-auto bg-white rounded-2xl p-10 mt-10">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-10">
            Liste des Jiris
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
            @if($jiris->isNotEmpty())
                <ul class="space-y-3">
                    @foreach($jiris as $jiri)
                        <li class="bg-white border border-gray-200 rounded-lg px-4 py-3 hover:shadow transition">
                            <a href="{{route('jiris.show', $jiri)}}" class="flex justify-between items-center" title="Vers le jiri {{$jiri->name}}">
                                <div>
                                    <p class="font-semibold text-gray-800">{!! $jiri->name !!}</p>
                                    @if($jiri->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $jiri->description }}</p>
                                    @endif
                                </div>
                                @if($jiri->date)
                                    <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($jiri->date)->format('d/m/Y') }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-sm italic text-center">Aucun jiri enregistré.</p>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{route('jiris.create')}}" class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                Créer un jiri
            </a>
        </div>
    </section>
</x-layouts.auth>
