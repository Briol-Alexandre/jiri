<?php use App\Enums\ContactRoles ?>
<x-layouts.auth>
    <section>
        <h2 class="text-2xl text-center font-bold text-blue-500 my-10">{{__('headings.create_a_contact')}}</h2>
        <form action="/contacts" method="post" class="flex flex-col gap-6 px-10 mx-auto" enctype="multipart/form-data">
            @csrf
            <div class="flex gap-6">
                <fieldset class="w-1/2 flex flex-col gap-5 border-r-gray-200 border-r pr-4">
                    <legend class="text-center font-bold text-xl">{{__('headings.create_a_contact')}}</legend>
                    <div class="relative">
                        <label for="name">
                            {{__('labels/contact.name')}} <small>({{ __('labels/contact.required') }})</small>
                        </label>
                        <input type="text" id="name" value="{{old('name')}}" name="name"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full"
                               placeholder="Design Web 0626">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="relative">
                        <label for="email">
                            {{__('labels/contact.email')}}
                        </label>
                        <input type="text" id="email" value="{{old('email')}}" name="email"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full"
                               placeholder="john.doe@domain.com">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="relative">
                        <label for="avatar">
                            {{__('labels/contact.avatar')}}
                        </label>
                        <input type="file"  id="avatar" value="{{old('avatar')}}" name="avatar"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('avatar')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>

                </fieldset>
                <fieldset class="w-1/2 flex flex-col gap-5">
                    <div class="flex justify-between items-center">
                        <legend class="text-center font-bold text-xl">{{__('headings.link_a_jiri')}}</legend>
                        <a href="{{route('jiris.create')}}"
                           class="text-center p-2 bg-blue-400 hover:cursor-pointer w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">
                            {{__('labels/buttons.jiri-create')}}
                        </a>
                    </div>
                    <div class="relative flex flex-col justify-around">
                        @if($jiris->count() !== 0)
                        @foreach($jiris as $jiri)
                            <div class="flex gap-10 border-b py-5 border-b-gray-300 last-of-type:border-b-0">
                                <div class="flex-1 flex items-center gap-5">
                                    <input type="checkbox" name="jiris[{{$jiri->id}}]"
                                           id="jiris[{{$jiri->id}}]" value="{{$jiri->id}}">
                                    <label for="jiris[{{$jiri->id}}]" class="flex flex-col">
                                        {{$jiri->name}}
                                        <small class="text-xs">{{$jiri->description}}</small>
                                    </label>
                                </div>
                                <div class="flex flex-col">
                                    <label for="roles[{{$jiri->id}}]" class="text-right">
                                        Rôle
                                    </label>
                                    <select name="roles[{{$jiri->id}}]" id="roles[{{$jiri->id}}]"
                                            class="border-2 p-1 border-blue-400 rounded-lg">
                                        <option
                                            value="{{ContactRoles::Evaluated}}">{{ContactRoles::Evaluated->value}}</option>
                                        <option
                                            value="{{ContactRoles::Evaluators}}">{{ContactRoles::Evaluators->value}}</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p>Pas encore de jiris</p>
                        @endif


                    </div>
                </fieldset>

            </div>
            <button type="submit"
                    class="p-2 mt-5 bg-blue-400 hover:cursor-pointer mx-auto w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">
                Créer le contact
            </button>
        </form>
    </section>
</x-layouts.auth>
