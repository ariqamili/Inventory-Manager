<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'business_id' => 1,
            'category_id' => 1,
            'name' => 'Laptop',
            'price' => 999.99,
            'stock' => 15,
            'description' => 'High-performance laptop for professionals',
        ]);

        Product::create([
            'business_id' => 1,
            'category_id' => 1,
            'name' => 'Smartphone',
            'price' => 699.99,
            'stock' => 8,
            'description' => 'Latest smartphone model with advanced features',
        ]);

        Product::create([
            'business_id' => 1,
            'category_id' => 1,
            'name' => 'Monitor',
            'price' => 299.99,
            'stock' => 12,
            'description' => '27-inch 4K monitor',
        ]);

        Product::create([
            'business_id' => 1,
            'category_id' => 2,
            'name' => 'Mouse',
            'price' => 29.99,
            'stock' => 50,
            'description' => 'Wireless ergonomic mouse',
        ]);

        Product::create([
            'business_id' => 1,
            'category_id' => 2,
            'name' => 'Keyboard',
            'price' => 79.99,
            'stock' => 5,
            'description' => 'Mechanical keyboard with RGB lighting',
        ]);

        Product::create([
            'business_id' => 1,
            'category_id' => 2,
            'name' => 'USB Cable',
            'price' => 9.99,
            'stock' => 100,
            'description' => 'USB-C charging cable',
        ]);

        Product::create([
            'business_id' => 2,
            'category_id' => 3,
            'name' => 'T-Shirt',
            'price' => 19.99,
            'stock' => 100,
            'description' => 'Cotton t-shirt available in multiple colors',
        ]);

        Product::create([
            'business_id' => 2,
            'category_id' => 3,
            'name' => 'Jeans',
            'price' => 59.99,
            'stock' => 30,
            'description' => 'Classic denim jeans',
        ]);

        Product::create([
            'business_id' => 2,
            'category_id' => 4,
            'name' => 'Sneakers',
            'price' => 89.99,
            'stock' => 25,
            'description' => 'Comfortable running sneakers',
        ]);

        echo "Products created successfully!\n";
    }
}