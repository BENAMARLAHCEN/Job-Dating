@extends('admin/layout/app')
@section('content')


    <a href="{{ route('companies.create') }}" class="btn btn-primary">add</a>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Industry</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{asset('logo/'.$company->logo)}}" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $company->name }}</p>
                                <p class="text-muted mb-0">{{ $company->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $company->location }}</p>
                    </td>
                    <td>
                        {{ $company->industry }}
                    </td>
                    <td> {{ $company->website }}
                    </td>
                    <td>
                        <a href="{{route('companies.edit',$company->id)}}" class="btn btn-sm btn-rounded">
                            Edit
                        </a>
                        <form action="{{route('companies.destroy',$company->id)}}" method="post">
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
        {{$companies->links('pagination::bootstrap-5')}}
    </div>


@endsection
