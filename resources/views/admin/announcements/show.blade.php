@extends('layout')

@section('content')
    
            <a href="/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                            class="w-80  mr-6 mb-6"
                            src="{{asset('uploads/'.$announcement->image)}}"
                            alt=""
                        />

                        <h3 class="text-2xl mb-2">{{$announcement->title}}</h3>
                        <div class="text-xl font-bold mb-4">{{$announcement->company->name}}</div>
                        <x-skills :skills="$announcement->skill"/>

                        <div class="text-lg mt-2">
                            <i class="fa-solid fa-location-dot"></i> {{$announcement->company->location}}
                        </div>
                        <div class="text-lg my-4">
                            <i class="fa-regular fa-clock"></i> {{$announcement->date}}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                                {{$announcement->description}}

                                <a
                                    href="mailto:{{$announcement->company->email}}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="{{$announcement->company->website}}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     
@endsection
