<?php use App\Enums\ContactRoles ?>
<x-layouts.auth>
    <section>
        <h2 class="text-2xl text-center font-bold text-blue-500 my-10">{!! __('headings.create_a_jiri') !!}</h2>
        <form action="/jiris" method="post" class="flex flex-col gap-6 px-10 mx-auto ">
            @csrf
            <div class="flex gap-6">
                <fieldset class="w-1/3 flex flex-col gap-5 border-r-gray-200 border-r pr-4">
                    <legend class="text-center font-bold text-xl mb-5">Créer le jiri</legend>
                    <div class="relative">
                        <label for="name">
                            {{ __('labels/jiri.name') }} <small>({{ __('labels/jiri.required') }})</small>
                        </label>
                        <input type="text" id="name" value="{{old('name')}}" name="name"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full"
                               placeholder="Lorem Ipsum">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="relative">
                        <label for="description">
                            Description du jiri
                        </label>
                        <input type="text" id="description" value="{{old('description')}}" name="description"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full"
                               placeholder="Lorem Ipsum">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="relative">
                        <label for="date">
                            Date du jiri <small>(requis)</small>
                        </label>
                        <input type="text" id="date" value="{{old('date')}}" name="date"
                               class="border border-gray-300 rounded-md block px-2 py-2 w-full"
                               placeholder="2025-06-24 08:00:00">
                        <small class="text-red-500 absolute -bottom-5">
                            @error('date')
                            {{ $message }}
                            @enderror
                        </small>
                    </div>
                </fieldset>

                <fieldset class="w-1/3 flex flex-col gap-5 border-r-gray-200 border-r pr-4">
                    <div class="flex justify-between items-center">
                        <legend class="text-center font-bold text-xl">Ajouter des contacts</legend>
                        <a href="{{route('contacts.create')}}"
                           class="text-center p-2 bg-blue-400 hover:cursor-pointer w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">Créer
                            un contact</a>
                    </div>
                    <div class="relative flex flex-col justify-around">
                        @if($contacts->count() !== 0)
                            @foreach($contacts as $contact)

                                <div class="flex gap-10 border-b py-5 border-b-gray-300 last-of-type:border-b-0">
                                    <div class="flex-1 flex items-center gap-5">
                                        <input type="checkbox" name="contacts[{{$contact->id}}]"
                                               id="contacts[{{$contact->id}}]" value="{{$contact->id}}">
                                        <label for="contacts[{{$contact->id}}]" class="flex flex-col">
                                            {{$contact->name}}
                                            <small class="text-xs">
                                                {{$contact->email}}
                                            </small>
                                        </label>

                                    </div>
                                    <div class="flex flex-col">
                                        <label for="roles[{{$contact->id}}]" class="text-right">
                                            Rôle
                                        </label>
                                        <select name="roles[{{$contact->id}}]" id="roles[{{$contact->id}}]"
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
                            <p>Pas encore de contact créé</p>
                        @endif


                    </div>
                </fieldset>

                <fieldset class="w-1/3 flex flex-col gap-5">
                    <div class="flex justify-between items-center">
                        <legend class="text-center font-bold text-xl">Ajouter des projets</legend>
                        <a href="{{route('projects.create')}}"
                           class="text-center p-2 bg-blue-400 hover:cursor-pointer w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">Créer
                            un projet</a>
                    </div>
                    <div class="relative flex flex-col justify-around">
                        @foreach($projects as $project)
                            <div class="flex gap-10 border-b py-5 border-b-gray-300 last-of-type:border-b-0">
                                <div class="flex-1 flex items-center gap-5">
                                    <input type="checkbox" name="projects[{{$project->id}}]"
                                           id="projects[{{$project->id}}]" value="{{$project->id}}">
                                    <label for="projects[{{$project->id}}]" class="flex flex-col">
                                        {{$project->name}}
                                        <small class="text-xs">{{$project->description}}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </fieldset>
            </div>
            <button type="submit"
                    class="p-2 mt-5 bg-blue-400 hover:cursor-pointer mx-auto w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">
                {{ __('labels/buttons.jiri-create') }}
            </button>
        </form>
    </section>
</x-layouts.auth>
