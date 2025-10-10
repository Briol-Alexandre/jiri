<div class="relative">
    <label for="{{$name}}" class="block text-sm">{{$label}}</label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{!! $placeholder ?? '' !!}"
           value="{{old($name)}}" class="border border-gray-200 rounded-md p-2 w-full">
    <span class="text-xs text-red-500 absolute left-0 -bottom-4">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>
