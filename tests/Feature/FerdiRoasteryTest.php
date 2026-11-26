<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FerdiRoasteryTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_home_displays_brand_logo_and_seeded_products(): void
    {
        $this->seed();

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Ferdi Roastery');
        $response->assertSee('logo-ferdi.png');
        $response->assertSee('Kopi Susu Gula Aren Ferdi');
        $response->assertSee('V60 Arabika Lampung');
        $response->assertSee('Matcha Cream Latte');
        $response->assertSee('Butter Croissant');
    }

    public function test_public_home_can_filter_by_category_and_show_product_detail(): void
    {
        $this->seed();

        $manualBrew = Category::where('name', 'Manual Brew')->firstOrFail();
        $v60 = Product::where('name', 'V60 Arabika Lampung')->firstOrFail();

        $filtered = $this->get(route('home', ['category' => $manualBrew->id]));
        $filtered->assertOk();
        $filtered->assertSee('V60 Arabika Lampung');
        $filtered->assertDontSee('Butter Croissant');

        $detail = $this->get(route('products.show', $v60));
        $detail->assertOk();
        $detail->assertSee('V60 Arabika Lampung');
        $detail->assertSee('Manual Brew');
        $detail->assertSee('Rp 28.000');
    }

    public function test_admin_can_create_update_and_delete_product_with_image_and_validation(): void
    {
        $this->seed();
        Storage::fake('public');

        $category = Category::firstOrFail();

        // Validation failure check
        $invalidResponse = $this->post(route('admin.products.store'), [
            'category_id' => '',
            'name' => '',
            'price' => 100,
            'description' => 'pendek',
        ]);
        $invalidResponse->assertSessionHasErrors(['category_id', 'name', 'price', 'description']);

        // Store with uploaded image
        $file = UploadedFile::fake()->image('espresso.jpg', 600, 600);
        $storeResponse = $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Single Espresso Ferdi',
            'price' => 18000,
            'description' => 'Ekstraksi espresso pekat dengan crema tebal dari biji pilihan Ferdi Roastery.',
            'image' => $file,
        ]);
        $storeResponse->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Single Espresso Ferdi')->firstOrFail();
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists($product->image);
        $oldImage = $product->image;

        // Update with new image
        $newFile = UploadedFile::fake()->image('espresso-baru.png', 600, 600);
        $updateResponse = $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Double Espresso Ferdi',
            'price' => 23000,
            'description' => 'Double shot espresso nikmat dengan aroma cokelat hitam dan karamel panggang.',
            'image' => $newFile,
        ]);
        $updateResponse->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertSame('Double Espresso Ferdi', $product->name);
        $this->assertSame(23000, $product->price);
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($product->image);

        // Delete product
        $imageToDelete = $product->image;
        $deleteResponse = $this->delete(route('admin.products.destroy', $product));
        $deleteResponse->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($imageToDelete);
    }
}
