<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ferdi Roastery — Coffee Shop & Artisan Roasting')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-ferdi.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --fr-forest: #1b3b2b;
            --fr-forest-dark: #132a1e;
            --fr-coffee: #5c3a21;
            --fr-coffee-light: #7a5234;
            --fr-cream: #f7f3eb;
            --fr-cream-card: #fffdf9;
            --fr-border: #e6dccb;
            --fr-text: #2b241f;
            --fr-muted: #6e6259;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--fr-cream);
            color: var(--fr-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .navbar-ferdi {
            background-color: var(--fr-forest);
            border-bottom: 3px solid var(--fr-coffee);
        }

        .navbar-brand-logo {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e7d7bf;
            background-color: #fff;
        }

        .btn-forest {
            background-color: var(--fr-forest);
            border-color: var(--fr-forest);
            color: #fff;
        }

        .btn-forest:hover, .btn-forest:focus {
            background-color: var(--fr-forest-dark);
            border-color: var(--fr-forest-dark);
            color: #fff;
        }

        .btn-coffee {
            background-color: var(--fr-coffee);
            border-color: var(--fr-coffee);
            color: #fff;
        }

        .btn-coffee:hover, .btn-coffee:focus {
            background-color: var(--fr-coffee-light);
            border-color: var(--fr-coffee-light);
            color: #fff;
        }

        .btn-outline-forest {
            color: var(--fr-forest);
            border-color: var(--fr-forest);
        }

        .btn-outline-forest:hover {
            background-color: var(--fr-forest);
            border-color: var(--fr-forest);
            color: #fff;
        }

        .badge-coffee {
            background-color: rgba(92, 58, 33, 0.12);
            color: var(--fr-coffee);
            border: 1px solid rgba(92, 58, 33, 0.25);
            font-weight: 600;
        }

        .card-ferdi {
            background-color: var(--fr-cream-card);
            border: 1px solid var(--fr-border);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-ferdi-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(27, 59, 43, 0.12);
        }

        .price-tag {
            color: var(--fr-forest);
            font-weight: 700;
        }

        .placeholder-coffee {
            background: linear-gradient(135deg, var(--fr-forest) 0%, var(--fr-coffee) 100%);
            color: #f7f3eb;
        }

        .footer-ferdi {
            background-color: var(--fr-forest-dark);
            color: #e9e2d5;
            margin-top: auto;
            border-top: 4px solid var(--fr-coffee);
        }

        .page-link {
            color: var(--fr-forest);
        }

        .page-item.active .page-link {
            background-color: var(--fr-forest);
            border-color: var(--fr-forest);
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-ferdi sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-ferdi.png') }}" alt="Logo Ferdi Roastery" class="navbar-brand-logo">
                <div>
                    <span class="font-serif fs-5 d-block lh-1">Ferdi Roastery</span>
                    <small class="text-white-50 fw-normal" style="font-size: 0.72rem;">UMKM Coffee &amp; Roastery Nusantara</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#menu">
                            <i class="bi bi-cup-hot me-1"></i> Daftar Menu
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-coffee btn-sm px-3 py-2 rounded-pill fw-semibold" href="{{ route('admin.products.index') }}">
                            <i class="bi bi-sliders me-1"></i> Admin Produk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="footer-ferdi py-4 mt-5">
        <div class="container">
            <div class="row gy-3 align-items-center">
                <div class="col-md-6 d-flex align-items-center gap-3">
                    <img src="{{ asset('images/logo-ferdi.png') }}" alt="Ferdi Roastery" class="navbar-brand-logo">
                    <div>
                        <h6 class="font-serif mb-1 text-white">Ferdi Roastery</h6>
                        <p class="mb-0 small text-white-50">
                            UMKM coffee shop yang menyajikan kopi nusantara hasil roasting terbaik, minuman non-kopi, dan camilan hangat.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 text-md-end small text-white-50">
                    <div><i class="bi bi-clock me-1"></i> Buka Setiap Hari: 08.00 – 22.00 WIB</div>
                    <div class="mt-1">&copy; {{ date('Y') }} Ferdi Roastery. Dibuat dengan Laravel &amp; Bootstrap 5.</div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
