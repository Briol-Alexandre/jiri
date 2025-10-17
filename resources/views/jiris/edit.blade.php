<?php use App\Enums\ContactRoles ?>
<x-layouts.auth>
    <section>
        <h2 class="text-2xl text-center font-bold text-blue-500 my-10">
            Modifier {{$jiri->name}}
        </h2>
        <form action="{{ route('jiris.update', $jiri) }}" method="post" class="flex flex-col gap-6 px-10 mx-auto ">
            @method('PATCH')
            @csrf
            <div class="flex gap-6">
                <fieldset class="w-1/3 flex flex-col gap-5 border-r-gray-200 border-r pr-4">
                    <legend class="text-center font-bold text-xl mb-5">Modifer le jiri</legend>
                    <x-input :name="'name'" :label="__('labels/jiri.name')" :type="'text'" :value="$jiri->name"/>
                    <x-input :name="'description'" :label="__('labels/jiri.description')" :type="'text'"
                             :value="$jiri->description"/>
                    <x-input :name="'date'" :label="__('labels/jiri.date')" :type="'text'" :value="$jiri->date"/>
                </fieldset>
                <fieldset class="w-1/3 flex flex-col gap-5 border-r-gray-200 border-r pr-4">
                    <div class="flex justify-between items-center">
                        <legend class="text-center font-bold text-xl">Modifier les participations</legend>
                        <a href="{{route('contacts.create')}}"
                           class="text-center p-2 bg-blue-400 hover:cursor-pointer w-40 text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">Créer
                            un contact</a>
                    </div>
                    <div class="relative flex flex-col justify-around">
                        @if($contacts->count() !== 0 || $assignedContacts !== 0)
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
                            @foreach($assignedContacts as $contact)
                                <div class="flex gap-10 border-b py-5 border-b-gray-300 last-of-type:border-b-0">
                                    <div class="flex-1 flex items-center gap-5">
                                        <input type="checkbox" name="contacts[{{$contact->id}}]"
                                               id="contacts[{{$contact->id}}]" value="{{$contact->id}}" checked>
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
                                            @if($contact->attendances->first()->role === ContactRoles::Evaluated->value)
                                                <option
                                                    value="{{ContactRoles::Evaluated}}"
                                                    selected>{{ContactRoles::Evaluated->value}}</option>
                                                <option
                                                    value="{{ContactRoles::Evaluators}}">{{ContactRoles::Evaluators->value}}</option>
                                            @else
                                                <option
                                                    value="{{ContactRoles::Evaluated}}">{{ContactRoles::Evaluated->value}}</option>
                                                <option
                                                    value="{{ContactRoles::Evaluators}}"
                                                    selected>{{ContactRoles::Evaluators->value}}</option>
                                            @endif
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
                        <legend class="text-center font-bold text-xl">Modifier des devoirs</legend>
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
                        @foreach($assignedProjects as $assignedProject)
                            <div class="flex gap-10 border-b py-5 border-b-gray-300 last-of-type:border-b-0">
                                <div class="flex-1 flex items-center gap-5">
                                    <input type="checkbox" name="projects[{{$assignedProject->id}}]"
                                           id="projects[{{$assignedProject->id}}]" value="{{$assignedProject->id}}"
                                           checked>
                                    <label for="projects[{{$assignedProject->id}}]" class="flex flex-col">
                                        {{$assignedProject->name}}
                                        <small class="text-xs">{{$assignedProject->description}}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </fieldset>
            </div>
            <button type="submit"
                    class="p-2 mt-5 bg-orange-400 hover:cursor-pointer mx-auto w-40 text-white border transition-all border-orange-400 rounded-md hover:bg-white hover:text-orange-400">
                Modifier ce jiri
            </button>

        </form>
    </section>
</x-layouts.auth>
