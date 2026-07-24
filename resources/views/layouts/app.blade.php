<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EngPersona')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ep-primary: #3ac46a;
            --ep-dark: #10231a;
            --ep-accent: #1e6dfb;
            --ep-bg: linear-gradient(120deg, #f5fff8 0%, #f0f6ff 100%);
        }
        body {
            background: var(--ep-bg);
            min-height: 100vh;
        }
        .ep-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 20px 50px rgba(16, 35, 26, 0.08);
        }
        .ep-brand {
            font-weight: 800;
            letter-spacing: 0.3px;
            color: var(--ep-dark);
        }
        .ep-badge {
            background: rgba(58, 196, 106, 0.14);
            color: #1f8a48;
            border-radius: 999px;
            padding: .35rem .75rem;
            font-size: .8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
@auth
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container py-1">
            <a class="navbar-brand ep-brand" href="{{ route('dashboard') }}">EngPersona</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('exercise.*')) active @endif" href="{{ route('exercise.start') }}">Mulai Latihan</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('review.*')) active @endif" href="{{ route('review.index') }}">Review</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('history.*')) active @endif" href="{{ route('history.index') }}">Riwayat</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('music.*')) active @endif" href="{{ route('music.index') }}">Musik</a></li>
                </ul>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
@endauth

<main class="container py-4 py-md-5">
    @if(session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif
    @if(session('exercise_message'))
        <div class="alert alert-success">{{ session('exercise_message') }}</div>
    @endif

    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
