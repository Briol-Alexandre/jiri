<!doctype html>
<html lang="{!! app()->getLocale() !!}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <h1 class="text-3xl text-center font-bold text-blue-500 my-10">{!! __('headings.create_a_jiri') !!}</h1>
        <form action="/jiris" method="post" class="flex flex-col gap-6 w-1/2 mx-auto">
            @csrf
            <div class="relative">
                <label for="name">
                    {{ __('labels/jiri.name') }} <small>({{ __('labels/jiri.required') }})</small>
                </label>
                <input type="text" id="name" value="{{old('name')}}" name="name" class="border border-gray-300 rounded-md block px-2 py-2 w-full"
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
                <input type="text" id="description" value="{{old('description')}}" name="description" class="border border-gray-300 rounded-md block px-2 py-2 w-full"
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
                <input type="text" id="date" value="{{old('date')}}" name="date" class="border border-gray-300 rounded-md block px-2 py-2 w-full" placeholder="2025-06-24 08:00:00">
                <small class="text-red-500 absolute -bottom-5">
                    @error('date')
                    {{ $message }}
                    @enderror
                </small>
            </div>
            <button type="submit"
                    class="p-2 mt-5 bg-blue-400 hover:cursor-pointer  text-white border transition-all border-blue-400 rounded-md hover:bg-white hover:text-blue-400">
                {{ __('labels/buttons.jiri-create') }}
            </button>
        </form>
    </body>
</html>
