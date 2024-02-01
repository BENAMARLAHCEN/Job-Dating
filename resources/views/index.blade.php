@extends('layout')

@section('content')

    <x-flash-message />

    @include('partials._hero')

    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($announcements) == 0)
            @foreach ($announcements as $announcement)
                <x-job-card :announcement="$announcement" />
            @endforeach
        @else
            <p class="text-red-400">No announcement found</p>
        @endunless
    </div>

    <div class="mt-9 p-4">
        {{ $announcements->links() }}
    </div>
@endsection
