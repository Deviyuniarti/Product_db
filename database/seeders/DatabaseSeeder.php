<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menambahkan produk spesifik
        Product::create([
            'name' => 'Acer',
            'price' => 150.00,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Ipad',
            'price' => 300.50,
            'stock' => 50,
        ]);


        Product::create([
            'name' => 'Samsung',
            'price' => 200.00,
            'stock' => 30,
        ]);

        Product::create([
            'name' => 'Koper',
            'price' => 450.75,
            'stock' => 10,
        ]);

        // Menghasilkan 50 produk palsu
        Product::factory()->count(50)->create();
    }
}
