<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'business_id' => 1,
            'name' => 'Electronics',
            'description' => 'Electronic devices and accessories',
        ]);

        Category::create([
            'business_id' => 1,
            'name' => 'Accessories',
            'description' => 'Tech accessories',
        ]);

        Category::create([
            'business_id' => 2,
            'name' => 'Clothing',
            'description' => 'Fashion clothing items',
        ]);

        Category::create([
            'business_id' => 2,
            'name' => 'Shoes',
            'description' => 'Footwear collection',
        ]);

        echo "Categories created successfully!\n";
    }
}