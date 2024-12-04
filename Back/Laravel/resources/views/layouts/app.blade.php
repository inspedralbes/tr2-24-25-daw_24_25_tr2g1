<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-light p-3">
        <div class="container">
            <h1 class="text-center">AlumNet</h1>
            <nav>
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Usuaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">Publications</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mt-4">
        @yield('content')
    </main>
</body>
</html>
