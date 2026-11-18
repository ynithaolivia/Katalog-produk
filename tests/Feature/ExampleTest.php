<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('catalog.index');
    }

    public function test_catalog_displays_products_and_searches_by_name(): void
    {
        $this->get('/katalog')
            ->assertOk()
            ->assertSee('Daftar Produk');
    }

    public function test_catalog_can_create_update_and_delete_a_product(): void
    {
        $create = $this->post('/katalog', [
            'name' => 'Buku Tulis',
            'category' => 'ATK',
            'price' => 3500,
            'stock' => 10,
        ]);

        $create->assertRedirect('/katalog');

        $product = Product::where('name', 'Buku Tulis')->firstOrFail();

        $this->put("/katalog/{$product->id}", [
            'name' => 'Buku Tulis Baru',
            'category' => 'ATK',
            'price' => 4000,
            'stock' => 8,
        ])->assertRedirect('/katalog');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Buku Tulis Baru',
            'price' => 4000,
            'stock' => 8,
        ]);

        $this->delete("/katalog/{$product->id}")
            ->assertRedirect('/katalog');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
