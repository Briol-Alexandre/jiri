<article class="bg-white  p-5 rounded-lg shadow-sm hover:cursor-pointer hover:bg-gray-50">
    <a href="{{$route}}">
        <h3 class="font-medium text-xl text-blue-600">
            {{$title}}
        </h3>
        <p class="text-sm">
            Nombre de {{strtolower($title)}} : {{$count}}
        </p>
    </a>
</article>
