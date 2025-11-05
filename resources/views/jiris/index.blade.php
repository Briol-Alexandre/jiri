@php use App\Enums\ContactRoles;use Carbon\Carbon; @endphp
<x-layouts.auth>
    <section class="max-w-5xl mx-auto p-10">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-10">
            Liste des Jiris
        </h2>

        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 overflow-x-auto">
            @if($jiris->isNotEmpty())
                <table class="w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-blue-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            <a href="
                                {{route('jiris.index', [
                                        'col' => 'name',
                                        'direction' => $col === 'name' && $direction === 'asc' ? 'desc' : 'asc',
                                ])}}
                                "
                               class="flex items-center gap-2">
                                Nom
                                <span>
                                        @if ($direction && $col === 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="25"
                                             height="25"
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
                                {{route('jiris.index', [
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            <a href="
                                {{route('jiris.index', [
                                        'col' => 'date',
                                        'direction' => $col === 'date' && $direction === 'asc' ? 'desc' : 'asc',
                                ])}}
                                "
                               class="flex">
                                Date
                                <span>
                                        @if ($direction && $col === 'date')
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
                            Nb. de projets
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            Nb. d'évalués
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b border-b-gray-200">
                            Nb. d'évaluateurs
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jiris as $jiri)
                        <tr class="hover:bg-gray-50 hover:cursor-pointer transition"
                            data-href="{{route('jiris.show', $jiri)}}">
                            <td class="px-4 py-3 border-b border-b-gray-200 font-semibold text-gray-800">
                                {!! $jiri->name !!}
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                @if($jiri->description)
                                    {{ $jiri->description }}
                                @else
                                    <span class="text-gray-400 italic">Aucune description</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                @if($jiri->date)
                                    {{ Carbon::parse($jiri->date)->format('d/m/Y') }}
                                @else
                                    <span class="text-gray-400 italic">Non définie</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                {{$jiri->projects->count()}}
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                {{$jiri->evaluated()->count()}}
                            </td>
                            <td class="px-4 py-3 border-b border-b-gray-200 text-gray-600">
                                {{$jiri->evaluators()->count()}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 text-sm italic text-center">Aucun jiri enregistré.</p>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{route('jiris.create')}}"
               class="p-2 hover:cursor-pointer w-fit bg-blue-400 text-white border transition-all border-blue-400 rounded-lg hover:bg-white hover:text-blue-400">
                Créer un jiri
            </a>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('tr[data-href]').forEach(row => {
                row.addEventListener('click', function (e) {
                    if (e.target.closest('a, button, form')) return;
                    window.location.href = this.dataset.href;
                });
            });
        });

    </script>
</x-layouts.auth>
