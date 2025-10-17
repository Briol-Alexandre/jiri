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


    </div>
</fieldset>
