@extends('admin/layout/app')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

    <a href="{{ route('skills.create') }}" class="btn btn-primary">add</a>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>creation date</th>
                <th>update date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skills as $skill)
                <tr>
                    <td>
                        <p class="fw-normal mb-1">{{ $skill->name }}</p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $skill->created_at }}</p>
                    </td>
                    <td>
                        {{ $skill->updated_at }}
                    </td>
                    
                    <td>
                        <a href="{{route('skills.edit',$skill->id)}}" class="btn btn-sm btn-rounded">
                            Edit
                        </a>
                        <form action="{{route('skills.destroy',$skill->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-rounded btn-danger">
                            Delete
                        </button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 p-2">
        {{$skills->links('pagination::bootstrap-5')}}
    </div>


@endsection
