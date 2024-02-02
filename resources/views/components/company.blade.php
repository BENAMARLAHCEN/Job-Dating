@props(['companies'])


<ul class="flex">

    @foreach($companies as $company)
        <li class="flex items-center justify-center bg-gray-500 text-white rounded-xl py-1 px-3 mr-2 text-xs hover:bg-gray-700 transition duration-300 ease-in-out">
            <a href="/company/{{$company->id}}" class="hover:text-yellow-300">
                {{$company->name}}
            </a>
        </li>
    @endforeach
</ul>