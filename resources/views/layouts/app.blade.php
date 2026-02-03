<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPN Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: #0d6efd !important; }
        .nav-link.active { font-weight: bold; border-bottom: 2px solid #0d6efd; }
        .card { border: none; shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">VPN Manager</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('configs.*') ? 'active' : '' }}" href="{{ route('configs.index') }}">Конфиги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}" href="{{ route('subscriptions.index') }}">Подписки</a>
                </li>
            </ul>
            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit">Выйти</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
