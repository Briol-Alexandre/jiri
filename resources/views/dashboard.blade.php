@php use Carbon\Carbon; @endphp
<x-layouts.auth>
    <section class="max-w-5xl mx-auto rounded-2xl p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10">
            Bienvenue {{auth()->user()->name}}
        </h2>

        <div class="grid grid-cols-3 gap-8">
            <x-dashboard.card :title="'Jiris'" :count="$user->jiris_count" :route="route('jiris.index')"/>
            <x-dashboard.card :title="'Contacts'" :count="$contacts->count()" :route="route('contacts.index')"/>
            <x-dashboard.card :title="'Projets'" :count="$projects->count()" :route="route('projects.index')"/>
            <article class="row-start-2 row-span-3 col-span-2 bg-white rounded-2xl p-5 shadow-sm">
                <div class="flex justify-between mb-4 items-center">
                    <h3 class="text-xl font-medium mb-4 text-blue-600">
                        Jiris à venir
                    </h3>
                    <a href="{{route('jiris.create')}}"
                       class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                        Créer un jiri
                    </a>
                </div>
                <ul class="px-5 flex flex-col gap-4 h-[250px] overflow-scroll py-2">
                    @foreach($upcommingJiris as $upcommingJiri)
                        <li class="block hover:bg-gray-50">
                            <a href="{{route('jiris.show', $upcommingJiri)}}"
                               class="p-3 rounded-xl shadow-sm flex justify-between">
                                -> {{$upcommingJiri->name}}
                                <span class="text-gray-500">
                                    {{ Carbon::parse($upcommingJiri->date)->format('d/m/Y') }}

                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </article>

            <x-dashboard.card_no_link :title="'implementations'" :model="$implementations"/>
            <x-dashboard.card_no_link :title="'attendances'" :model="$attendances"/>
            <x-dashboard.card_no_link :title="'assignments'" :model="$assignments"/>


        </div>

    </section>
</x-layouts.auth>
