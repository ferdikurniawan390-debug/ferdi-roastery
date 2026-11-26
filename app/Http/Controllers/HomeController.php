<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public landing page and product catalog for Ferdi Roastery.
     */
    public function index(Request $request): View
    {
        $activeCategoryId = $request->integer('category') ?: null;
        $search = trim((string) $request->query('search', ''));

        $categories = Category::withCount('products')
            ->orderBy('id')
            ->get();

        $products = Product::with('category')
            ->when($activeCategoryId, function ($query, int $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('id')
            ->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products,
            'activeCategoryId' => $activeCategoryId,
            'search' => $search,
        ]);
    }

    /**
     * Display the detail page for a single menu product.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('id')
            ->limit(3)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
