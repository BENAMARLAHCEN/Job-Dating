@props(['announcement'])
<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{ asset('uploads/' . $announcement->image) }}" alt="" />
        <div>
            <h3 class="text-2xl">
                <a href="/announcement/{{ $announcement->id }}">{{ $announcement->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4"> <x-company :companies="$announcement->company" />
            </div>
            <x-skills :skills="$announcement->skills" />

            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>{{ $announcement->location }}
                <i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::create( $announcement->date)->diffForHumans() }}
            </div>
            <div>
                @auth
                    @hasrole('learner')
                        <p>Matching Percentage: {{ $announcement->matchingPercentage }}%</p>
                        @if ($announcement->matchingPercentage >= 50)
                            <p>Congratulations! You are qualified for this announcement.</p>
                        @endif
                    @endhasrole
                @endauth
            </div>
        </div>
    </div>
</div>
