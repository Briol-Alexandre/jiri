<x-layouts.guest>
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
                <a href="{{route('register')}}"
                   class="text-blue-500 hover:underline">{!! __('headings.create_account') !!}</a>
            </div>
        </form>
    </x-Auth.form>
</x-layouts.guest>
