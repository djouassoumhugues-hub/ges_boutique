<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Boutique - Monsieur Ali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="brand-icon">🏪</div>
                Boutique M. Ali
            </a>
            <div class="navbar-nav ms-auto d-flex flex-row gap-1">
                <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                    <i class="ti ti-users" aria-hidden="true"></i> Clients
                </a>
                <a class="nav-link {{ request()->is('produits*') ? 'active' : '' }}" href="{{ route('produits.index') }}">
                    <i class="ti ti-package" aria-hidden="true"></i> Produits
                </a>
                <a class="nav-link {{ request()->is('commandes*') ? 'active' : '' }}" href="{{ route('commandes.index') }}">
                    <i class="ti ti-file-invoice" aria-hidden="true"></i> Commandes
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>