@extends('admin/layout/app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a href="{{ route('announcements.create') }}" class="btn btn-primary">add</a>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Skills</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/' . $announcement->image) }}" alt=""
                                style="width: 100px; height: 80px" class="" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $announcement->title }}</p>
                                <p class="text-muted mb-0">
                                    @foreach ($announcement->company as $company)
                                        {{ $company->name }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $announcement->date }}</p>
                    </td>
                    <td>
                        @foreach ($announcement->skill as $skill)
                            {{ $skill->name }}
                        @endforeach
                    </td>
                    <td class=" text-overflow">
                        {{ $announcement->description }}
                    </td>

                    <td>
                        <a href="{{ route('announcements.edit', $announcement->id) }}"
                            class="btn btn-warning btn-sm btn-rounded">
                            Edit
                        </a>
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-rounded btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 p-2">
        {{ $announcements->links('pagination::bootstrap-5') }}
    </div>
@endsection
