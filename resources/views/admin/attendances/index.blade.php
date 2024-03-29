@extends('admin/layout/app')


@section('content')



    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Learner</th>
                <th>Announce Title</th>
                <th>creation date</th>
                <th>update date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/1706735706.jpg') }}" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $attendance->user->name }}</p>
                                <p class="text-muted mb-0">
                                    {{ $attendance->user->email }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class=" text-overflow">
                        {{ $attendance->announcement->title }}
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $attendance->created_at }}</p>
                    </td>
                    <td>
                        {{ $attendance->updated_at }}
                    </td>

                    <td>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="post">
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
        {{ $attendances->links('pagination::bootstrap-5') }}
    </div>
@endsection
