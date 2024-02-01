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

    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="company" class="form-label">Company Name</label>
            <select name="company_id" class="form-select">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Job Title</label>
            <input type="text" class="form-control" name="title" value="{{ $announcement->title }}"
                placeholder="Example: Senior Laravel Developer">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="{{ $announcement->date }}">
        </div>

        <div class="mb-3">
            <label for="skills" class="form-label">Skills (Comma Separated)</label>
            <input type="text" class="form-control" name="skills" value="{{ $announcement->skills }}"
                placeholder="Example: Laravel, Backend, Postgres, etc">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ $announcement->image }}">
            <img class="w-50 my-2" src="{{ asset('uploads/' . $announcement->image) }}" alt="" />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Job Description</label>
            <textarea class="form-control" name="description" rows="5" placeholder="Include tasks, requirements, salary, etc">{{ $announcement->description }}</textarea>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Create</button>
            <a href="/" class="btn btn-secondary ml-4">Back</a>
        </div>
    </form>
@endsection
