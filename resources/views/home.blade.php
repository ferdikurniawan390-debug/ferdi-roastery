@extends('layouts.app')

@section('title', 'Ferdi Roastery — Kopi Nusantara Hasil Roasting Terbaik')

@push('styles')
<style>
    .hero-ferdi {
        background: radial-gradient(circle at top right, rgba(92, 58, 33, 0.55), transparent 55%),
                    linear-gradient(135deg, #132a1e 0%, #1b3b2b 60%, #2a4d3a 100%);
        color: #f7f3eb;
    }

    .hero-logo-wrap {
        width: 128px;
        height: 128px;
        border-radius: 50%;
        padding: 6px;
        background: linear-gradient(135deg, #d7b889, #5c3a21);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    .hero-logo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        background: #fff;
    }

    .product-thumb-box {
        height: 220px;
        overflow: hidden;
    }

    .filter-pill {
        border: 1px solid var(--fr-border);
        background-color: var(--fr-cream-card);
        color: var(--fr-text);
    }

    .filter-pill:hover, .filter-pill.active {
        background-color: var(--fr-forest);
        border-color: var(--fr-forest);
        color: #fff;
    }
</style>
@endpush

@section('content')
    <!-- Hero & Identitas UMKM -->
    <section class="hero-ferdi py-5">
        <div class="container py-lg-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 border border-light border-opacity-25 small mb-3">
                        <i class="bi bi-stars text-warning"></i>
                        <span>UMKM Coffee Shop Lokal &bull; Freshly Roasted Daily</span>
                    </div>

                    <h1 class="display-5 fw-bold mb-3">
                        Cita Rasa Kopi Nusantara Terbaik di <span style="color: #e6c48c;">Ferdi Roastery</span>
                    </h1>

                    <p class="lead text-white-50 mb-4" style="max-width: 680px;">
                        Ferdi Roastery adalah UMKM coffee shop yang menghadirkan biji kopi nusantara pilihan hasil roasting terbaik, mulai dari racikan Signature Coffee, seduhan Manual Brew autentik, minuman Non-Coffee yang menyegarkan, hingga camilan hangat yang dipanggang setiap hari.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#menu" class="btn btn-coffee btn-lg rounded-pill px-4 fw-semibold">
                            <i class="bi bi-cup-hot me-2"></i>Lihat Daftar Menu
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">
                            <i class="bi bi-pencil-square me-2"></i>Kelola Menu (Admin)
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 text-center">
                    <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-light border-opacity-10 d-inline-block">
                        <div class="hero-logo-wrap mx-auto mb-3">
                            <img src="{{ asset('images/logo-ferdi.png') }}" alt="Logo Ferdi Roastery">
                        </div>
                        <h5 class="font-serif mb-1 text-white">Ferdi Roastery</h5>
                        <p class="small text-white-50 mb-0">
                            "Dari Biji Pilihan Nusantara ke Cangkir Anda"
                        </p>
                    </div>
                </div>
            </div>

            <!-- Keunggulan Singkat -->
            <div class="row g-3 mt-4 pt-2">
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-light border-opacity-10 h-100 d-flex align-items-start gap-3">
                        <i class="bi bi-fire fs-4" style="color: #e6c48c;"></i>
                        <div>
                            <h6 class="mb-1 fw-semibold text-white">Sangrai Segar Setiap Pekan</h6>
                            <p class="small text-white-50 mb-0">Profil roasting terjaga agar aroma dan karakter rasa kopi selalu optimal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-light border-opacity-10 h-100 d-flex align-items-start gap-3">
                        <i class="bi bi-geo-alt fs-4" style="color: #e6c48c;"></i>
                        <div>
                            <h6 class="mb-1 fw-semibold text-white">Biji Kopi Petani Nusantara</h6>
                            <p class="small text-white-50 mb-0">Mendukung petani kopi lokal dari Lampung, Aceh Gayo, hingga Toraja.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-light border-opacity-10 h-100 d-flex align-items-start gap-3">
                        <i class="bi bi-bag-heart fs-4" style="color: #e6c48c;"></i>
                        <div>
                            <h6 class="mb-1 fw-semibold text-white">Non-Kopi &amp; Camilan Hangat</h6>
                            <p class="small text-white-50 mb-0">Tersedia matcha, cokelat artisan, dan aneka pastry renyah setiap hari.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Produk Dinamis -->
    <section id="menu" class="py-5">
        <div class="container">
            <div class="row align-items-end gy-3 mb-4">
                <div class="col-lg-7">
                    <span class="text-uppercase fw-semibold small" style="color: var(--fr-coffee); letter-spacing: 0.08em;">
                        Menu Pilihan Kami
                    </span>
                    <h2 class="fw-bold mt-1 mb-1">Daftar Menu Ferdi Roastery</h2>
                    <p class="text-muted mb-0">
                        Klik pada produk untuk melihat informasi lengkap mengenai karakter rasa dan deskripsi menu.
                    </p>
                </div>

                <div class="col-lg-5">
                    <form action="{{ route('home') }}#menu" method="GET" class="d-flex gap-2">
                        @if ($activeCategoryId)
                            <input type="hidden" name="category" value="{{ $activeCategoryId }}">
                        @endif
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                class="form-control border-start-0"
                                placeholder="Cari kopi, matcha, croissant..."
                            >
                        </div>
                        <button type="submit" class="btn btn-forest px-3">Cari</button>
                        @if ($search !== '' || $activeCategoryId)
                            <a href="{{ route('home') }}#menu" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a
                    href="{{ route('home', array_filter(['search' => $search])) }}#menu"
                    class="btn btn-sm rounded-pill px-3 py-2 filter-pill {{ ! $activeCategoryId ? 'active' : '' }}"
                >
                    Semua Menu
                </a>
                @foreach ($categories as $category)
                    <a
                        href="{{ route('home', array_filter(['category' => $category->id, 'search' => $search])) }}#menu"
                        class="btn btn-sm rounded-pill px-3 py-2 filter-pill {{ $activeCategoryId === $category->id ? 'active' : '' }}"
                    >
                        {{ $category->name }}
                        <span class="badge rounded-pill ms-1 {{ $activeCategoryId === $category->id ? 'bg-light text-dark' : 'bg-secondary bg-opacity-10 text-dark' }}">
                            {{ $category->products_count }}
                        </span>
                    </a>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <div class="card card-ferdi p-5 text-center">
                    <div class="mb-3">
                        <i class="bi bi-cup-hot fs-1 text-muted"></i>
                    </div>
                    <h4 class="fw-bold">Menu Belum Ditemukan</h4>
                    <p class="text-muted mb-3">
                        Belum ada menu yang cocok dengan filter atau kata kunci pencarian Anda.
                    </p>
                    <div>
                        <a href="{{ route('home') }}#menu" class="btn btn-forest rounded-pill px-4">Tampilkan Semua Menu</a>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card card-ferdi card-ferdi-hover h-100 d-flex flex-column">
                                <a href="{{ route('products.show', $product) }}" class="text-decoration-none product-thumb-box d-block">
                                    @include('partials.product-image', ['product' => $product])
                                </a>

                                <div class="card-body d-flex flex-column p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge rounded-pill badge-coffee px-3 py-1">
                                            {{ $product->category->name ?? 'Menu' }}
                                        </span>
                                        <span class="price-tag fs-5">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>

                                    <h5 class="card-title font-serif fw-bold mb-2">
                                        <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark stretched-link">
                                            {{ $product->name }}
                                        </a>
                                    </h5>

                                    <p class="card-text text-muted small mb-3 flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($product->description, 105) }}
                                    </p>

                                    <div class="pt-2 border-top d-flex align-items-center justify-content-between" style="border-color: var(--fr-border) !important;">
                                        <span class="small fw-semibold" style="color: var(--fr-coffee);">
                                            Lihat Detail Menu
                                        </span>
                                        <i class="bi bi-arrow-right-circle fs-5" style="color: var(--fr-forest);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
