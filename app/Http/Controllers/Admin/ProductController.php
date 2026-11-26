<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products in the admin dashboard.
     */
    public function index(): View
    {
        $products = Product::with('category')
            ->latest('id')
            ->paginate(10);

        return view('admin.products.index', [
            'products' => $products,
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'productsWithImage' => Product::whereNotNull('image')->count(),
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan ke menu Ferdi Roastery.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        if ($request->boolean('remove_image') && $product->image) {
            Storage::disk('public')->delete($product->image);
            $validated['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Data produk "' . $product->name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $productName = $product->name;

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk "' . $productName . '" berhasil dihapus.');
    }

    /**
     * Validate store and update requests with shared server-side rules.
     */
    private function validateProduct(Request $request): array
    {
        return $request->validate(
            [
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                'name' => ['required', 'string', 'max:120'],
                'price' => ['required', 'integer', 'min:1000', 'max:10000000'],
                'description' => ['required', 'string', 'min:10', 'max:2000'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ],
            [
                'category_id.required' => 'Kategori produk wajib dipilih.',
                'category_id.exists' => 'Kategori yang dipilih tidak valid.',
                'name.required' => 'Nama produk wajib diisi.',
                'name.max' => 'Nama produk maksimal 120 karakter.',
                'price.required' => 'Harga produk wajib diisi.',
                'price.integer' => 'Harga produk harus berupa angka bulat (tanpa titik atau koma).',
                'price.min' => 'Harga produk minimal Rp 1.000.',
                'price.max' => 'Harga produk maksimal Rp 10.000.000.',
                'description.required' => 'Deskripsi produk wajib diisi.',
                'description.min' => 'Deskripsi produk minimal 10 karakter agar informatif.',
                'description.max' => 'Deskripsi produk maksimal 2000 karakter.',
                'image.image' => 'File yang diunggah harus berupa gambar.',
                'image.mimes' => 'Format foto produk harus JPG, JPEG, atau PNG.',
                'image.max' => 'Ukuran foto produk maksimal 2 MB.',
            ]
        );
    }
}
