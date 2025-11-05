<a class="hover:text-blue-500 group transition-all flex justify-between  items-center hover:bg-blue-100 py-4 px-2 hover:pl-4 rounded-md {{$active}}"
   href="{{$link}}">
    <div class="flex gap-1 items-center">
        {{$slot}}
        <p>{{$title}}</p>
    </div>
    <span class="group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="10" height="10"
                         viewBox="0 0 185.343 185.343"><path
                            d="M51.707 185.343a10.692 10.692 0 0 1-7.593-3.149 10.724 10.724 0 0 1 0-15.175l74.352-74.347L44.114 18.32c-4.194-4.194-4.194-10.987 0-15.175 4.194-4.194 10.987-4.194 15.18 0l81.934 81.934c4.194 4.194 4.194 10.987 0 15.175l-81.934 81.939a10.678 10.678 0 0 1-7.587 3.15z"
                            fill="currentColor"/></svg>
                </span>
</a>
