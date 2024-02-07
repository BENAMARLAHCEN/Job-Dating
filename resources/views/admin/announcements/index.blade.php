@extends('admin/layout/app')


@section('content')
    @if (session()->has('success'))
        <div id="alertMessage"
            class="alert alert-success position-fixed top-0 start-50 translate-middle-x px-4 py-3 rounded-md">
            <p class="mb-0">
                {{ session('success') }}
            </p>
            <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert(this)"></button>
        </div>

        <script>
            setTimeout(function() {
                closeAlert();
            }, 3000);

            function closeAlert() {
                var alertMessage = document.getElementById('alertMessage');
                if (alertMessage) {
                    alertMessage.style.display = 'none';
                }
            }
        </script>
    @endif
    <a href="{{ route('announcements.create') }}" class="btn btn-primary">add</a>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Skills</th>
                <th>Description</th>
                <th>Attendances</th>
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
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $announcement->date }}</p>
                    </td>
                    <td class=" text-overflow">
                        @foreach ($announcement->skills as $skill)
                            {{ $skill->name }}
                        @endforeach
                    </td>
                    <td class=" text-overflow">
                        {{ $announcement->description }}
                    </td>
                    <td>
                        {{ $announcement->attendances->count() }}
                    </td>

                    <td>
                        <div class=" d-flex gap-1 md-wrap">
                        <a href="{{ route('announcements.edit', $announcement->id) }}"
                            class="btn btn-warning btn-sm btn-rounded">
                            Edit
                        </a>
                        <a href="/announcement/{{ $announcement->id }}"
                            class="btn btn-success btn-sm btn-rounded">
                            Show
                        </a>
                        
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-rounded btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                        <a href="{{ route('attendances.index').'?announce='.$announcement->id }}"
                            class="btn btn-warning btn-sm btn-rounded">
                            Show attendances
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 p-2">
        {{ $announcements->links('pagination::bootstrap-5') }}
    </div>
@endsection
