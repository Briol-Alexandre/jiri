<div class="flex fixed bg-white top-0 h-screen w-[250px] shadow-md px-6 py-10 justify-center border-b mb-5">
    <h1 class="sr-only">
        Jiri
    </h1>
    <nav class="flex flex-col justify-between text-blue-300 gap-4 w-full">
        <h2 class="sr-only">Navigation principale</h2>
        <div class="flex flex-col gap-4">
            <p class="text-2xl text-blue-600 font-bold flex flex-col mx-auto text-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2c3e67"
                     class="w-12 aspect-auto">
                    <path d="M12 2 1 7l11 5 9-4.09V17h2V7L12 2z"/>
                    <path d="M4 10v6c0 2.21 3.58 4 8 4s8-1.79 8-4v-6l-8 3.64L4 10z"/>
                </svg>
                <span class="-mt-2">
                Jiri
            </span>
            </p>
            <x-nav.navElements :link="'/'" :title="'Dashboard'" :active="request()->is('/') ? 'active text-blue-500 font-bold pl-4 bg-blue-100' : ''">
                <x-icons.dashboard/>
            </x-nav.navElements>
            <x-nav.navElements :link="route('jiris.index')" :title="'Jiri'" :active="request()->is('jiris') ? 'active text-blue-500 font-bold pl-4 bg-blue-100' : ''">
                <x-icons.jiri/>
            </x-nav.navElements>
            <x-nav.navElements :link="route('contacts.index')" :title="'Contacts'" :active="request()->is('contacts') ? 'active text-blue-500 font-bold pl-4 bg-blue-100' : ''">
                <x-icons.contact/>
            </x-nav.navElements>
            <x-nav.navElements :link="route('projects.index')" :title="'Projets'" :active="request()->is('projects') ? 'active text-blue-500 font-bold pl-4 bg-blue-100' : ''">
                <x-icons.project/>
            </x-nav.navElements>
        </div>
        <div>
            @php
                $user = auth()->user();
                $name = $user->name;
                $firstAndLastName = explode(' ', $name);
                $firstName = $firstAndLastName[0];
                $lastName = $firstAndLastName[1];
                $initials = $firstName[0] . $lastName[0];
            @endphp
            <a href="{{route('users.edit', $user)}}" class="text-gray-600 hover:bg-gray-100 py-4 pl-2 rounded-md flex gap-2 text-xs items-center">
                <span
                    class="w-14 aspect-square rounded-full border border-gray-300 bg-gray-100 flex items-center justify-center">
                    @if($user->avatar)
                        <img src="" alt="">
                    @else
                        {{$initials}}
                    @endif
                </span>
                <span>
                    <span>{{$user->name}}</span>
                    <small class="text-gray-400">{{$user->email}}</small>
                </span>
            </a>
            <form action="{{route('logout')}}" method="post" class="">
                @csrf
                <button
                    class="hover:text-red-500 transition-all flex gap-1 items-center hover:bg-red-100 py-4 pl-2 rounded-md w-full text-left text-red-300">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.5 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V4.16667C17.5 3.72464 17.3244 3.30072 17.0118 2.98816C16.6993 2.67559 16.2754 2.5 15.8333 2.5H12.5"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.6665 14.1667L2.49984 10L6.6665 5.83337" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M2.5 10H12.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>
    </nav>
</div>
