<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ADMIN-AlumNet')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header class="bg-light p-3">
        <div class="container">
            <nav>
                <h1 class="text-center">AlumNet</h1>
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Usuaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publicacions.index') }}">Publicacions</a>
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
