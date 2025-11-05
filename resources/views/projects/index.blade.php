<x-layouts.auth>
    <section class="max-w-5xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10">
            Liste des Projets
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 overflow-x-auto">
            @if($projects->isNotEmpty())
                <table class="w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-blue-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            <a href="
                            {{route('projects.index', [
                                    'col' => 'name',
                                    'direction' => $col === 'name' && $direction === 'asc' ? 'desc' : 'asc',
                            ])}}
                            "
                               class="flex">
                                Nom
                                <span>
                                    @if ($direction && $col === 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="20"
                                             height="20"
                                             style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"
                                             viewBox="0 0 64 64"
                                             class="{{ $direction === 'desc' ? 'rotate-180' : '' }}">
                                            <path d="M0 0h1280v800H0z" style="fill:none"
                                                  transform="translate(-1216 -320)"/>
                                            <path d="M288 216h-32v-4h28v-28h4v32Z"
                                                  style="fill:#d9d9d9;fill-rule:nonzero"
                                                  transform="rotate(45 251.554 -111.565) scale(.73957 .74269)"/>
                                            <path d="M288 216h-32v-4h28v-28h4v32Z"
                                                  style="fill-rule:nonzero"
                                                  transform="rotate(-135 91.467 122.942) scale(.73957 .74269)"/>
                                        </svg>
                                    @endif
                                </span>

                            </a>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            <a href="
                            {{route('projects.index', [
                                    'col' => 'description',
                                    'direction' => $col === 'description' && $direction === 'asc' ? 'desc' : 'asc',
                            ])}}
                            "
                               class="flex">
                                Description
                                <span>
                                    @if ($direction && $col === 'description')
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="20"
                                             height="20"
                                             style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"
                                             viewBox="0 0 64 64"
                                             class="{{ $direction === 'desc' ? 'rotate-180' : '' }}">
                                            <path d="M0 0h1280v800H0z" style="fill:none"
                                                  transform="translate(-1216 -320)"/>
                                            <path d="M288 216h-32v-4h28v-28h4v32Z"
                                                  style="fill:#d9d9d9;fill-rule:nonzero"
                                                  transform="rotate(45 251.554 -111.565) scale(.73957 .74269)"/>
                                            <path d="M288 216h-32v-4h28v-28h4v32Z"
                                                  style="fill-rule:nonzero"
                                                  transform="rotate(-135 91.467 122.942) scale(.73957 .74269)"/>
                                        </svg>
                                    @endif
                                </span>

                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b border-b-gray-200 font-semibold text-gray-800">
                                <a href="{{route('projects.show', $project)}}" class="block text-gray-800 hover:text-blue-600">{!! $project->name !!}</a>
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                <a href="{{route('projects.show', $project)}}" class="block text-gray-600 hover:text-blue-600">
                                    @if($project->description)
                                        {{ $project->description }}
                                    @else
                                        <span class="text-gray-400 italic">Aucune description</span>
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 text-sm italic text-center">Aucun projet enregistré.</p>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{route('projects.create')}}"
               class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                Créer un projet
            </a>
        </div>
    </section>
</x-layouts.auth>
