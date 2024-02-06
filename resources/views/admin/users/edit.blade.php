@extends('admin/layout/app')
@section('content')
    @if ($errors->any())
        <div id="alert-additional-content-2"
            class="alert alert-danger alert-dismissible border rounded-lg bg-light text-danger" role="alert">
            <div class="flex items-center">
                <span class="sr-only">Whoops!</span>
                <h3 class="text-lg font-medium">There were some problems with your input.</h3>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="mt-2 mb-4 text-sm">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">User Image</label>
            <input type="file" class="form-control" name="image" >
            <img class="w-50 my-2" src="{{ asset('images/' . $user->image) }}" alt="" />
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" aria-label="Select Role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Update</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary ml-4">Back</a>
        </div>
    </form>
@endsection
