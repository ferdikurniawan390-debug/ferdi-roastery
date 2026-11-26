@php
    $heightClass = $heightClass ?? 'h-100';
    $categoryName = $product->category->name ?? 'Menu';
    $icon = match (true) {
        str_contains(strtolower($categoryName), 'pastry') || str_contains(strtolower($categoryName), 'snack') => 'bi-basket2-fill',
        str_contains(strtolower($categoryName), 'non-coffee') => 'bi-cup-straw',
        str_contains(strtolower($categoryName), 'manual') => 'bi-droplet-half',
        default => 'bi-cup-hot-fill',
    };
@endphp

@if ($product->image)
    <img
        src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}"
        class="w-100 {{ $heightClass }}"
        style="object-fit: cover;"
    >
@else
    <div class="w-100 {{ $heightClass }} placeholder-coffee d-flex flex-column align-items-center justify-content-center text-center p-4">
        <div class="rounded-circle bg-white bg-opacity-10 d-flex align-items-center justify-content-center mb-2" style="width: 68px; height: 68px;">
            <i class="bi {{ $icon }} fs-2 text-warning-emphasis" style="color: #f4d8a8 !important;"></i>
        </div>
        <span class="font-serif fw-semibold small text-white-50 text-uppercase tracking-wide">{{ $categoryName }}</span>
        <span class="fw-semibold text-white mt-1">{{ $product->name }}</span>
    </div>
@endif
