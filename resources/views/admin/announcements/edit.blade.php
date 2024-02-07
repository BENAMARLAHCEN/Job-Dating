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

    <form action="{{ route('announcements.update',$announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="company" class="form-label">Company Name</label>
            <select class="form-select" name="company_ids[]" id="multiple-select-field" data-placeholder="Company" multiple>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                        {{ in_array($company->id, $announcement->company->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $company->name }}</option>
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
            <select class="form-select" name="skill_ids[]" id="multiple-select-field-skills" data-placeholder="Company"
                multiple>

                @foreach ($skills as $skill)
                    <option value="{{ $skill->id }}"
                        {{ in_array($skill->id, $announcement->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $skill->name }}</option>
                @endforeach
            </select>
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
    <script>
        $(document).ready(function() {

            $('#multiple-select-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });

        });
    </script>
    <script>
        $(document).ready(function() {

            $('#multiple-select-field-skills').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });

        });
    </script>
@endsection
