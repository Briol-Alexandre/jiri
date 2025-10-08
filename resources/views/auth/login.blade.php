<!doctype html>
<html lang="{!! app()->getLocale() !!}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <title>Login</title>

    </head>
    <body class="bg-gray-50 mx-5 flex h-[100vh] items-center justify-center">
        <x-Auth.form :title="__('headings.login')">
            <form action="{{ route('login.store') }}" method="post"
                  class="flex flex-col gap-6 w-full lg:w-1/2 lg:border-l lg:border-l-gray-200 lg:pl-20">
                @csrf
                <x-input :label="__('labels/auth.email')" :name="'email'" :type="'email'"/>
                <x-input :label="__('labels/auth.password')" :name="'password'" :type="'password'" :placeholder="'••••••••••
••••••••••'"/>

                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <x-checkbox :name="'remember-me'" :value="__('labels/auth.remember')"/>
                    <a href="/" class="text-xs text-blue-500 hover:underline">{!! __('labels/auth.forgot') !!}</a>
                </div>

                <x-button :value="__('labels/buttons.login')"/>
                <div class="flex text-sm justify-around items-center flex-col lg:flex-row">
                    <p>{!! __('labels/auth.no-login') !!}</p>
                    <a href="{{route('register')}}" class="text-blue-500 hover:underline">{!! __('labels/buttons.login') !!}</a>
                </div>
            </form>
        </x-Auth.form>
    </body>
</html>
