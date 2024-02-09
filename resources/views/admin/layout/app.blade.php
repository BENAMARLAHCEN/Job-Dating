<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

    {{-- select 2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<body>



    <div id="wrapper">

        <!-- Sidebar -->
        <aside id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{ route('companies.index') }}">
                        JobDating
                    </a>
                </li>

                <li>
                    <a href="{{ route('companies.index') }}">Companies</a>
                </li>
                <li>
                    <a href="{{ route('announcements.index') }}">
                        Announcements
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendances.index') }}">Attendances</a>
                </li>
                <li>
                    <a href="{{ route('skills.index') }}">Skills</a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">Roles</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">Users</a>
                </li>

            </ul>
        </aside>
        <!-- /#sidebar-wrapper -->
        <!-- Navbar -->
        <nav class="navbar justify-content-space-between pe-4 ps-2">
            <button class="btn " id="menu-toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar  gap-4">

                <div class="card new w-auto">
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-icon pe-md-0 position-relative " data-bs-toggle="dropdown">
                            <img src="{{ asset('images/lahcen.JPG') }}" alt="icon" style="max-width: 2.5rem;"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end position-absolute">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="profile.php">Account Setting</a>
                            <a class="dropdown-item" href="include/logout.php">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar -->
        {{-- success message --}}
        @if ($message = Session::get('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ $message }}",
                });
            </script>
        @endif
        <!-- Page Content -->

        <div id="page-content-wrapper">
            <div class="container-fluid">


                @yield('content')


            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>


</html>
