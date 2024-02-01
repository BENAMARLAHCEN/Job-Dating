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

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>

        <div class="mb-3">
            <label for="industry" class="form-label">Industry</label>
            <input type="text" class="form-control" name="industry" value="{{old('industry')}}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{old('location')}}" placeholder="Example: Remote, Boston MA, etc">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{old('email')}}">
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website/Application URL</label>
            <input type="text" class="form-control" name="website" value="{{old('website')}}">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Company Logo</label>
            <input type="file" class="form-control" name="logo" >
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Create</button>
            <a href="/" class="btn btn-secondary ml-4">Back</a>
        </div>
    </form>
@endsection
