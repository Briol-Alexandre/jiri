<x-layouts.guest>
    <x-Auth.form :title="__('headings.register')">
        <form action="{{ route('register.store') }}" method="post"
              class="flex flex-col gap-6 w-full lg:w-1/2 lg:border-l lg:border-l-gray-200 lg:pl-20">
            @csrf
            <x-input :label="__('labels/auth.name')" :name="'name'" :type="'text'" :placeholder="'John Doe'" value=""/>
            <x-input :label="__('labels/auth.email')" :name="'email'" :type="'email'"
                     :placeholder="'john.doe@domain.com'" value=""/>
            <x-input :label="__('labels/auth.password')" :name="'password'" :type="'password'"
                     :placeholder="'••••••••••'" value=""/>
            <x-input :label="__('labels/auth.confirm-password')" :name="'password_confirmation'" :type="'password'"
                     :placeholder="'••••••••••'" value=""/>
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <x-checkbox :name="'remember-me'" :value="__('labels/auth.remember')"/>
                <a href="/" class="text-xs text-blue-500 hover:underline">{!! __('labels/auth.forgot') !!}</a>
            </div>
            <x-button :value="__('labels/buttons.register')"/>
            <div class="flex text-sm justify-around items-center flex-col lg:flex-row">
                <p>{!! __('labels/auth.already') !!}</p>
                <a href="{{route('login')}}"
                   class="text-blue-500 hover:underline">{!! __('labels/buttons.login') !!}</a>
            </div>
        </form>
    </x-Auth.form>
</x-layouts.guest>
