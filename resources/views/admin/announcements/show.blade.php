@extends('layout')

@section('content')
    <x-success-message/>

        <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                <div class="flex flex-col items-center justify-center text-center">
                    <img class="w-80  mr-6 mb-6" src="{{ asset('uploads/' . $announcement->image) }}" alt="" />

                    <h3 class="text-2xl mb-2">{{ $announcement->title }}</h3>
                    <div class="text-xl font-bold mb-4">
                        <x-company :companies="$announcement->company" />
                    </div>
                    <x-skills :skills="$announcement->skills" />

                    <div class="text-lg mt-2">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="text-lg my-4">
                        <i class="fa-regular fa-clock"></i> {{ $announcement->date }}
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <h3 class="text-3xl font-bold mb-4">
                            Job Description
                        </h3>
                        <div class="text-lg space-y-6">
                            {{ $announcement->description }}

                            <a href="mailto:" class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-envelope"></i>
                                Contact Employer</a>

                            <a href="" target="_blank"
                                class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-globe"></i> Visit
                                Website</a>

                            {{-- Inside your announcement view --}}
                            @if (auth()->check())
                                @if ($announcement->hasUserRecordedAttendance(auth()->id()))
                                    @if (now() < $announcement->date)
                                        <form method="post"
                                            action="{{ route('announcements.unrecordAttendance', $announcement->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit">Unrecord Attendance</button>
                                        </form>
                                    @else
                                        <p>The job interview day has already passed. Attendance cannot be recorded.</p>
                                    @endif
                                @else
                                    <form method="post"
                                        action="{{ route('announcements.recordAttendance', $announcement->id) }}">
                                        @csrf
                                        <button type="submit">Record Attendance</button>
                                    </form>
                                @endif
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
