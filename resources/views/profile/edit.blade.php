@extends('layout')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <x-flash-message />

    <div class="h-full bg-gray-200 p-8">
        <div class="bg-white rounded-lg shadow-xl pb-8">
            @auth
                @if (auth()->user()->id === $user->id)
                    <div x-data="{ openSettings: false }" class="absolute right-12 mt-4 rounded">
                        <button @click="openSettings = !openSettings"
                            class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20"
                            title="Settings">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                </path>
                            </svg>
                        </button>
                        <div x-show="openSettings" @click.away="openSettings = false"
                            class="bg-white absolute right-0 w-40 py-2 mt-1 border border-gray-200 shadow-2xl"
                            style="display: none;">
                            <div class="py-2 border-b">
                                <p class="text-gray-400 text-xs px-6 uppercase mb-1">Settings</p>
                                <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                        </path>
                                    </svg>
                                    <a href="{{route('profile.edit')}}" class="text-sm text-gray-700">Edit Profile</a>
                                </button>
                                <form action="" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                            </path>
                                        </svg>
                                        <span class="text-sm text-gray-700">Block Account</span>
                                    </button>
                                </form>
                            </div>
                            <div class="py-2">
                                <p class="text-gray-400 text-xs px-6 uppercase mb-1">Feedback</p>
                                <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-gray-700">Report</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
            <div class="w-full h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
                    class="w-full h-full rounded-tl-lg rounded-tr-lg">
            </div>
            <div class="flex flex-col items-center -mt-20">
                <img src="{{ asset('images/' . $user->image) }}" class="w-40 border-4 border-white rounded-full">
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{ $user->name }}</p>
                    <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                </div>
                <p class="text-gray-700">{{ $user->profile->job }}</p>
                <p class="text-sm text-gray-500">{{ $user->profile->location }}</p>
            </div>
            <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                <div class="flex items-center space-x-4 mt-2">
                    <button
                        class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                            </path>
                        </svg>
                        <span>Connect</span>
                    </button>
                    <button
                        class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>Message</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
            <div class="w-full flex flex-col 2xl:w-1/3">
                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                    <h4 class="text-xl text-gray-900 font-bold">Edit Personal Info</h4>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="mt-2 text-gray-700">
                            <li class="flex border-y py-2">
                                <span class="font-bold w-24">Full name:</span>
                                <input type="text" name="name" value="{{ $user->name }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Birthday:</span>
                                <input type="date" name="birthday" value="{{ $user->profile->birthday }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Mobile:</span>
                                <input type="tel" name="mobile" value="{{ $user->profile->mobile }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Location:</span>
                                <input type="text" name="location" value="{{ $user->profile->location }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Job:</span>
                                <input type="text" name="job" value="{{ $user->profile->job }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Address:</span>
                                <input type="text" name="address" value="{{ $user->profile->address }}" class="block w-full rounded-md border-0 text-gray-900">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Elsewhere:</span>
                                <input type="url" name="linkedin" value="{{ $user->profile->linkedin }}" class="text-gray-700" placeholder="LinkedIn">
                                <input type="url" name="github" value="{{ $user->profile->github }}" class="text-gray-700" placeholder="Github">
                                <input type="url" name="facebook" value="{{ $user->profile->facebook }}" class="text-gray-700" placeholder="Facebook">
                                <input type="url" name="instagram" value="{{ $user->profile->instagram }}" class="text-gray-700" placeholder="Instagram">
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Bio:</span>
                                <textarea name="bio"  rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900   focus:ring-2 focus:ring-inset focus:ring-indigo-600">{{ $user->profile->bio }}</textarea>
                            </li>
                        </ul>
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
                    </form>
                </div>
                
                {{-- <div class="flex-1 bg-white rounded-lg shadow-xl mt-4 p-8">
                    <h4 class="text-xl text-gray-900 font-bold">Activity log</h4>
                    <form action="{{ route('user.skills.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex items-center">
                            <select name="new_skills[]" class="select-form" id="select-state" multiple
                                placeholder="Select a skills..." autocomplete="off">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}"
                                        {{ in_array($skill->id, $user->skills->pluck('id')->toArray()) ? 'disabled' : '' }}>
                                        {{ $skill->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-4">Add</button>
                        </div>
                    </form>

                    <div class="px-4 mt-4">
                        @foreach ($user->skills as $skill)
                            <span
                                class="inline-block px-2 py-1 font-bold bg-red-400 text-white rounded-lg hover:bg-gray-500 mr-4 mb-2">
                                <form action="{{ route('user.skills.delete', $skill->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    {{ $skill->name }}
                                    <button type="submit" class="ml-2 focus:outline-none"><i
                                            class="fas fa-times"></i></button>
                                </form>
                            </span>
                        @endforeach

                    </div>
                </div> --}}
                <div class="flex-1 bg-white rounded-lg shadow-xl mt-4 p-8">
                    <h4 class="text-xl text-gray-900 font-bold">Activity log</h4>
                    <form action="{{ route('user.skills.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class=" px-5 flex items-center gap-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Add</button>
                            <select name="new_skills[]" class="form-select  w-auto min-w-[33%]" id="select-state" multiple
                                placeholder="Select a skills..." autocomplete="off">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}"
                                        {{ in_array($skill->id, $user->skills->pluck('id')->toArray()) ? 'disabled' : '' }}>
                                        {{ $skill->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </form>
                
                    <div class="px-4 mt-4">
                        @foreach ($user->skills as $skill)
                            <span class="inline-block px-2 py-1 bg-red-400 text-white rounded-lg hover:bg-red-500 mr-2 mb-2">
                                <form action="{{ route('user.skills.delete', $skill->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    {{ $skill->name }}
                                    <button type="submit" class="ml-2 focus:outline-none"><i class="fas fa-times"></i></button>
                                </form>
                            </span>
                        @endforeach
                    </div>
                </div>
                

            </div>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
            <h4 class="text-xl text-gray-900 font-bold">Change Password</h4>
            <form method="POST" action="{{ route('profile.updatePassword') }}">
                @csrf
                @method('PUT')
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <span class="font-bold">Current Password:</span>
                        <input type="password" name="current_password" class="text-gray-700 ml-2">
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold">New Password:</span>
                        <input type="password" name="password" class="text-gray-700 ml-2">
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold">Confirm New Password:</span>
                        <input type="password" name="password_confirmation" class="text-gray-700 ml-2">
                    </li>
                </ul>
                <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">Update Password</button>
            </form>
        </div>
        
        
        
        
    </div>

    <script>
        new TomSelect("#select-state", {});
    </script>
@endsection
