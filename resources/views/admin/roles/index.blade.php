@extends('admin/layout/app')

@section('content')

    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">Add Role</a>

    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions</label>
                            <select class="form-select" id="permissions" name="permissions[]" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Role Name</th>
                <th>creation date</th>
                <th>update date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>
                        <p class="fw-normal mb-1">{{ $role->name }}</p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $role->created_at }}</p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ $role->updated_at }}</p>
                    </td>

                    <td>
                        <div class="d-flex gap-1 md-wrap">
                            <button type="button" class="btn btn-warning btn-sm btn-rounded" data-bs-toggle="modal"
                                data-bs-target="#updateRoleModal{{ $role->id }}">
                                Edit
                            </button>

                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-rounded btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- update model --}}
                <div class="modal fade" id="updateRoleModal{{ $role->id }}" tabindex="-1"
                    aria-labelledby="updateRoleModalLabel{{ $role->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateRoleModalLabel{{ $role->id }}">Update Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('roles.update', $role->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="updateRoleName" class="form-label">Role Name</label>
                                        <input type="text" class="form-control" id="updateRoleName" name="name"
                                            value="{{ $role->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="updatePermissions" class="form-label">Permissions</label>
                                        <select class="form-select updatePermissions" name="permissions[]" multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                                                    {{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Role</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 p-2">
        {{ $roles->links('pagination::bootstrap-5') }}
    </div>

    <script>
        $(document).ready(function() {
            $('.updatePermissions').each(function() {
                $(this).select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: false
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#permissions').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });

        });
    </script>
@endsection
