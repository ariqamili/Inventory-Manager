<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE transactions, products, categories, users, businesses RESTART IDENTITY CASCADE');

        $this->call([
            BusinessSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        Business::factory(5)->create()->each(function ($business) {
            
            Category::factory(5)->create([
                'business_id' => $business->id
            ])->each(function ($category) use ($business) {
                
                Product::factory(20)->create([
                    'business_id' => $business->id,
                    'category_id' => $category->id,
                ]);
            });

            User::factory(2)->create([
                'business_id' => $business->id,
                'role' => 'worker',
            ]);
        });
    }
}