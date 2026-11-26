<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = collect([
            'Signature Coffee',
            'Manual Brew',
            'Non-Coffee',
            'Pastry & Snack',
        ])->mapWithKeys(function (string $name) {
            $category = Category::firstOrCreate(['name' => $name]);

            return [$name => $category->id];
        });

        $products = [
            [
                'category' => 'Signature Coffee',
                'name' => 'Kopi Susu Gula Aren Ferdi',
                'price' => 24000,
                'description' => 'Racikan khas Ferdi Roastery memadukan double shot espresso house blend medium-dark roast dengan susu segar creamy dan sirup gula aren organik asli nusantara.',
                'image' => 'products/kopi-susu-gula-aren.svg',
            ],
            [
                'category' => 'Manual Brew',
                'name' => 'V60 Arabika Lampung',
                'price' => 28000,
                'description' => 'Seduhan manual pour-over V60 menggunakan biji Arabika pilihan dari dataran tinggi Lampung dengan profil rasa citrus segar, cokelat hitam, dan aftertaste manis yang bersih.',
                'image' => 'products/v60-arabika-lampung.svg',
            ],
            [
                'category' => 'Signature Coffee',
                'name' => 'Iced Americano',
                'price' => 22000,
                'description' => 'Espresso house blend hasil roasting segar yang dituang di atas es batu dan air mineral dingin, menghadirkan karakter body seimbang dengan aroma karamel dan kacang panggang.',
                'image' => 'products/iced-americano.svg',
            ],
            [
                'category' => 'Non-Coffee',
                'name' => 'Matcha Cream Latte',
                'price' => 27000,
                'description' => 'Perpaduan bubuk ceremonial matcha berkualitas dengan susu segar lembut dan lapisan cream foam gurih-manis, cocok bagi penikmat minuman non-kopi yang menenangkan.',
                'image' => 'products/matcha-cream-latte.svg',
            ],
            [
                'category' => 'Pastry & Snack',
                'name' => 'Butter Croissant',
                'price' => 25000,
                'description' => 'Croissant panggang hangat setiap pagi dengan lapisan pastry renyah keemasan di luar dan tekstur lembut beraroma mentega premium di dalam.',
                'image' => 'products/butter-croissant.svg',
            ],
            [
                'category' => 'Manual Brew',
                'name' => 'Japanese Iced Coffee Gayo',
                'price' => 30000,
                'description' => 'Kopi single origin Aceh Gayo yang diseduh langsung di atas es menggunakan teknik flash brew untuk mengunci aroma floral, berry, dan keasaman buah yang cerah.',
                'image' => 'products/japanese-iced-coffee-gayo.svg',
            ],
            [
                'category' => 'Non-Coffee',
                'name' => 'Artisan Dark Chocolate',
                'price' => 26000,
                'description' => 'Minuman cokelat pekat dari kakao lokal Sulawesi Selatan yang diolah bersama susu hangat atau dingin, kaya rasa cokelat murni tanpa pemanis berlebih.',
                'image' => 'products/artisan-dark-chocolate.svg',
            ],
            [
                'category' => 'Pastry & Snack',
                'name' => 'Almond Choco Danish',
                'price' => 28000,
                'description' => 'Pastry danish berlapis renyah berisi cokelat hitam leleh dan taburan irisan kacang almond panggang, pasangan sempurna untuk menemani secangkir kopi.',
                'image' => 'products/almond-choco-danish.svg',
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category_id' => $categories[$item['category']],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                ]
            );
        }
    }
}
