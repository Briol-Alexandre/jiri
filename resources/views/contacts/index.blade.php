<x-layouts.auth>
    <section class="px-4 gap-5 flex flex-col">
        <h2 class="text-xl font-bold">Liste des Contacts</h2>
        @if($contacts->count() !== 0)
            <ul class="pl-5">
                @foreach($contacts as $contact)
                    <li>
                        <a href="{{route('contacts.show', $contact)}}" class="underline"
                           title="Vers le contact {{$contact->name}}">
                            {!! $contact->name !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Il n'y a pas encore de contacts</p>
        @endif
        <a href="{{route('contacts.create')}}"
           class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">Créer
            un contact</a>
    </section>
</x-layouts.auth>
