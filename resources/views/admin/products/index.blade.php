@extends('layouts.app')

@section('title', 'Admin Produk — Ferdi Roastery')

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <span class="text-uppercase small fw-semibold" style="color: var(--fr-coffee);">Panel Admin UMKM</span>
                <h1 class="h2 fw-bold mb-1">Kelola Daftar Produk</h1>
                <p class="text-muted mb-0">Tambah, perbarui, unggah foto, atau hapus menu Ferdi Roastery.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-forest rounded-pill px-3">
                    <i class="bi bi-eye me-1"></i> Lihat Beranda
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-forest rounded-pill px-4 fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                </a>
            </div>
        </div>

        <!-- Ringkasan Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-sm-4">
                <div class="card card-ferdi p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="small text-muted d-block">Total Menu</span>
                            <span class="fs-4 fw-bold" style="color: var(--fr-forest);">{{ $totalProducts }}</span>
                        </div>
                        <i class="bi bi-cup-hot fs-2" style="color: var(--fr-coffee);"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-ferdi p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="small text-muted d-block">Kategori</span>
                            <span class="fs-4 fw-bold" style="color: var(--fr-forest);">{{ $totalCategories }}</span>
                        </div>
                        <i class="bi bi-tags fs-2" style="color: var(--fr-coffee);"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-ferdi p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="small text-muted d-block">Produk Berfoto</span>
                            <span class="fs-4 fw-bold" style="color: var(--fr-forest);">{{ $productsWithImage }}</span>
                        </div>
                        <i class="bi bi-image fs-2" style="color: var(--fr-coffee);"></i>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        <div class="card card-ferdi shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: var(--fr-forest); color: #fff;">
                        <tr>
                            <th class="ps-4 py-3" style="width: 60px;">No</th>
                            <th class="py-3" style="width: 96px;">Foto</th>
                            <th class="py-3">Nama Produk</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Harga</th>
                            <th class="pe-4 py-3 text-end" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td class="ps-4 text-muted fw-semibold">
                                    {{ $products->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="rounded-3 overflow-hidden border" style="width: 64px; height: 64px;">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <div class="w-100 h-100 placeholder-coffee d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cup-hot text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <div class="small text-muted">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill badge-coffee px-3 py-1">
                                        {{ $product->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="fw-semibold" style="color: var(--fr-forest);">
                                    {{ $product->formatted_price }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-secondary" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-forest" title="Edit Produk">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk {{ addslashes($product->name) }}?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Produk">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada produk terdaftar. Klik <strong>Tambah Produk</strong> untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="card-footer bg-transparent border-top px-4 py-3">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
