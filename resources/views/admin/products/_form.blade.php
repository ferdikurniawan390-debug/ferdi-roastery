@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-4">
        <div class="fw-bold mb-1">
            <i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat kesalahan pada isian form:
        </div>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label for="category_id" class="form-label fw-semibold">Kategori Produk <span class="text-danger">*</span></label>
        <select
            name="category_id"
            id="category_id"
            class="form-select @error('category_id') is-invalid @enderror"
            required
        >
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text">Rp</span>
            <input
                type="number"
                name="price"
                id="price"
                min="1000"
                step="500"
                value="{{ old('price', $product->price ?? '') }}"
                class="form-control @error('price') is-invalid @enderror"
                placeholder="Contoh: 25000"
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <label for="name" class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
        <input
            type="text"
            name="name"
            id="name"
            maxlength="120"
            value="{{ old('name', $product->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Contoh: Kopi Susu Gula Aren Ferdi"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label fw-semibold">Deskripsi Menu <span class="text-danger">*</span></label>
        <textarea
            name="description"
            id="description"
            rows="4"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Jelaskan komposisi, asal biji kopi, profil rasa, atau saran penyajian..."
            required
        >{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="image" class="form-label fw-semibold">Foto Produk (Opsional)</label>
        <input
            type="file"
            name="image"
            id="image"
            accept=".jpg,.jpeg,.png"
            class="form-control @error('image') is-invalid @enderror"
        >
        <div class="form-text">Format yang didukung: JPG, JPEG, atau PNG dengan ukuran maksimal 2 MB.</div>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if (! empty($product?->image))
            <div class="mt-3 p-3 rounded-3 border bg-white d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="rounded-3 border"
                    style="width: 96px; height: 96px; object-fit: cover;"
                >
                <div>
                    <div class="small fw-semibold mb-1">Foto saat ini tersimpan</div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                        <label class="form-check-label small text-danger" for="remove_image">
                            Hapus foto produk saat ini
                        </label>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
    <button type="submit" class="btn btn-forest rounded-pill px-4 fw-semibold">
        <i class="bi bi-save me-1"></i> {{ $submitLabel ?? 'Simpan Produk' }}
    </button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        Batal
    </a>
</div>
