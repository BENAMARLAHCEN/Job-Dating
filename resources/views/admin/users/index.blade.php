@extends('admin/layout/app')

@section('content')


<a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Permission</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/' . $user->image) }}" alt="{{$user->image}}"
                            style="width: 45px; height: 45px" class="rounded-circle" />
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $user->name }}</p>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    @foreach ($user->roles as $item)
                        {{ $item->name.'' }}
                    @endforeach
                    {{-- {{ $user->roles[0]->name ?? '' }} --}}
                </td>
                <td class="text-overflow">
                    @foreach ($user->getAllPermissions() as $item)
                        {{ $item->name.',' }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-rounded">
                        Edit
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
    {{ $users->links('pagination::bootstrap-5') }}
</div>

@endsection

