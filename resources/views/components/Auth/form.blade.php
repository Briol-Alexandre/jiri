<div
    class="lg:mx-auto lg:w-3/4 w-full shadow-md rounded-xl py-5 lg:py-20 px-5 lg:px-10 bg-white lg:flex lg:items-center lg:justify-between">

    <div class="flex flex-col items-center lg:w-1/2 lg:pr-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2c3e67"
             class="w-16 h-16 lg:w-24 lg:h-24">
            <path d="M12 2 1 7l11 5 9-4.09V17h2V7L12 2z"/>
            <path d="M4 10v6c0 2.21 3.58 4 8 4s8-1.79 8-4v-6l-8 3.64L4 10z"/>
        </svg>

        <h1 class="text-xl lg:text-2xl text-center font-medium text-gray-800 mb-5">
            {{$title}}
        </h1>
    </div>

    {{$slot}}
</div>
