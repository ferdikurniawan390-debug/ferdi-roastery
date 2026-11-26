@extends('layouts.app')

@section('title', $product->name . ' — Ferdi Roastery')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--fr-forest);">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('home', ['category' => $product->category_id]) }}#menu" class="text-decoration-none" style="color: var(--fr-coffee);">
                        {{ $product->category->name ?? 'Menu' }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="card card-ferdi shadow-sm">
            <div class="row g-0">
                <div class="col-lg-6" style="min-height: 340px;">
                    @include('partials.product-image', ['product' => $product, 'heightClass' => 'h-100'])
                </div>

                <div class="col-lg-6 d-flex flex-column p-4 p-lg-5">
                    <div class="mb-3">
                        <span class="badge rounded-pill badge-coffee px-3 py-2">
                            <i class="bi bi-tag-fill me-1"></i>{{ $product->category->name ?? 'Menu Ferdi Roastery' }}
                        </span>
                    </div>

                    <h1 class="fw-bold mb-2">{{ $product->name }}</h1>

                    <div class="fs-3 price-tag mb-4">
                        {{ $product->formatted_price }}
                    </div>

                    <div class="mb-4">
                        <h6 class="text-uppercase small fw-bold text-muted mb-2">Deskripsi &amp; Karakter Rasa</h6>
                        <p class="mb-0 lh-lg" style="white-space: pre-line;">{{ $product->description }}</p>
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color: var(--fr-cream); border: 1px dashed var(--fr-border);">
                        <div class="d-flex align-items-center gap-2 small fw-semibold" style="color: var(--fr-forest);">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Disajikan Segar oleh Barista Ferdi Roastery</span>
                        </div>
                        <p class="small text-muted mb-0 mt-1">
                            Semua sajian kopi diracik menggunakan biji pilihan hasil sangrai lokal dengan standar kualitas terbaik.
                        </p>
                    </div>

                    <div class="mt-auto d-flex flex-wrap gap-2">
                        <a href="{{ route('home') }}#menu" class="btn btn-forest rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Menu
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-forest rounded-pill px-4">
                            <i class="bi bi-pencil-square me-1"></i> Edit di Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($relatedProducts->isNotEmpty())
            <section class="mt-5">
                <h3 class="fw-bold mb-3">Menu Lainnya dalam Kategori {{ $product->category->name ?? '' }}</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($relatedProducts as $related)
                        <div class="col">
                            <div class="card card-ferdi card-ferdi-hover h-100">
                                <a href="{{ route('products.show', $related) }}" class="d-block" style="height: 180px; overflow: hidden;">
                                    @include('partials.product-image', ['product' => $related])
                                </a>
                                <div class="card-body p-3">
                                    <h6 class="font-serif fw-bold mb-1">
                                        <a href="{{ route('products.show', $related) }}" class="text-decoration-none text-dark stretched-link">
                                            {{ $related->name }}
                                        </a>
                                    </h6>
                                    <span class="price-tag small">{{ $related->formatted_price }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
