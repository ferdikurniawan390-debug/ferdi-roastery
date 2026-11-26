@extends('layouts.app')

@section('title', 'Edit ' . $product->name . ' — Admin Ferdi Roastery')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-4">
                    <a href="{{ route('admin.products.index') }}" class="text-decoration-none small fw-semibold" style="color: var(--fr-forest);">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Produk
                    </a>
                    <h1 class="h2 fw-bold mt-2 mb-1">Edit Produk: {{ $product->name }}</h1>
                    <p class="text-muted mb-0">Perbarui detail, harga, kategori, atau foto produk Ferdi Roastery.</p>
                </div>

                <div class="card card-ferdi shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            @include('admin.products._form', [
                                'product' => $product,
                                'submitLabel' => 'Simpan Perubahan',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
