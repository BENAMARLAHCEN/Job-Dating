<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "rgb(10, 101, 204)",
                    },
                },
            },
        };
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>JobDating | Find Jobs & Projects</title>
</head>

<body class="">
    <nav class="flex justify-between items-center mb-4 mt-2 ms-2">

        <div class="w-[168px] h-10 justify-start items-center gap-2 inline-flex">
            <div class="w-10 h-10 relative">
                <a href="/">
                    <img class="w-24" src="{{ asset('images/briefcase.svg') }}" alt="" class="logo" />
                </a>
            </div>
            <div class="text-zinc-900 text-2xl font-semibold font-['Inter'] leading-10">JobDating</div>
        </div>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                <li>
                    <span class="font-bold uppercase">
                        Welcome {{ auth()->user()->name }}
                    </span>
                </li>
                @if (Auth::user()->hasRole('admin','cme'))
                    <li>
                        <a href="/companies" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage</a>
                    </li>
                    @else
                    <li>
                        <a href="/profile" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Profile</a>
                    </li>
                @endif
                <li>
                    <form class="inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('register') }}" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i>
                        Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="hover:text-laravel"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a>
                </li>
            @endauth

        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="bottom-0 left-0  flex items-center justify-center font-bold bg-laravel text-white h-20 mt-10 ">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        {{-- <a href="create.html" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a> --}}
    </footer>
</body>

</html>
