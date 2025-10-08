<x-layouts.auth>
    <section class="px-4 gap-5 flex flex-col">
        <h2 class="text-xl font-bold">Liste des Jiris</h2>
        <ul class="pl-5">
            @foreach($jiris as $jiri)
                <li>
                    <a href="{{route('jiris.show', $jiri)}}" class="underline" title="Vers le jiri {{$jiri->name}}">
                        {!! $jiri->name !!}
                    </a>
                </li>
            @endforeach
        </ul>

        <a href="{{route('jiris.create')}}" class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">Créer un jiri</a>
    </section>
</x-layouts.auth>
