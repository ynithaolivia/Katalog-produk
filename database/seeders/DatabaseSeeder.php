<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $products = [
            ['name' => 'Kopi Endek', 'category' => 'Minuman', 'price' => 15000, 'stock' => 12],
            ['name' => 'Teh Kotak', 'category' => 'Minuman', 'price' => 5000, 'stock' => 0],
            ['name' => 'Roti Cokelat', 'category' => 'Makanan', 'price' => 8000, 'stock' => 24],
            ['name' => 'Keripik Pedas', 'category' => 'Makanan Ringan', 'price' => 12000, 'stock' => 18],
            ['name' => 'Air Mineral', 'category' => 'Minuman', 'price' => 4000, 'stock' => 32],
            ['name' => 'Susu Cokelat', 'category' => 'Minuman', 'price' => 7000, 'stock' => 0],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
