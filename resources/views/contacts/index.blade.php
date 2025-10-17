@php $sizes = config('contactavatars.sizes') @endphp
<x-layouts.auth>
    <section class="max-w-5xl mx-auto bg-white rounded-2xl p-10 mt-10">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-10">
            Liste des Contacts
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
            @if($contacts->count() !== 0)
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($contacts as $contact)
                        <li class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow transition">
                            <a href="{{route('contacts.show', $contact)}}"
                               class="flex flex-col justify-center items-center"
                               title="Vers le contact {{$contact->name}}">
                                <img src="{{asset('images/contacts/originals/'.$contact->avatar)}}"
                                     @foreach($sizes as $size)
                                         srcset="{{asset('images/contacts/variants/'. $size['width'] . 'x' . $size['height'] . '/' .$contact->avatar)}} {{$size['width']}}w"
                                     sizes="{{$size['width']}}"
                                     @endforeach
                                     alt="image de {{$contact->name}}"
                                     class="w-24 aspect-square object-cover rounded-full mb-3">
                                <p class="font-semibold text-gray-800 text-center">{!! $contact->name !!}</p>
                                <span class="text-sm text-gray-500 text-center">{{$contact->email}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-sm italic text-center">Il n'y a pas encore de contacts</p>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{route('contacts.create')}}"
               class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                Créer un contact
            </a>
        </div>
    </section>
</x-layouts.auth>
