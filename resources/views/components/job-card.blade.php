
    @props(['announcement'])
    <div class="bg-gray-50 border border-gray-200 rounded p-6">
        <div class="flex">
            <img class="hidden w-48 mr-6 md:block" src="{{asset('uploads/'.$announcement->image)}}" alt="" />
            <div>
                <h3 class="text-2xl">
                    <a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a>
                </h3>
                <div class="text-xl font-bold mb-4">{{$announcement->company->name}}</div>
                <x-skills :skillsCsv="$announcement->skills"/>

                <div class="text-lg mt-4">
                    <i class="fa-solid fa-location-dot"></i> {{$announcement->company->location}}
                    <i class="fa-solid fa-date-dot"></i> {{$announcement->date}}
                </div>
            </div>
        </div>
    </div>


