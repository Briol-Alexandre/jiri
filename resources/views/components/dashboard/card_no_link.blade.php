<article class="row-span-1  p-5 rounded-lg  bg-white shadow-sm">
    <h3 class="font-medium text-xl text-blue-600">
        {{ucfirst($title)}}
    </h3>
    <p class="text-sm">
        Nombre d'{{$title}} : {{$model->count()}}
    </p>
</article>
