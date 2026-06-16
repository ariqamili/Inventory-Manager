<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        Business::create([
            'name' => 'Tech Store',
            'address' => '123 Main St, New York, NY 10001',
            'phone' => '(555) 123-4567',
            'description' => 'Your one-stop shop for all tech needs',
        ]);

        Business::create([
            'name' => 'Fashion Boutique',
            'address' => '456 Oak Ave, Los Angeles, CA 90001',
            'phone' => '(555) 987-6543',
            'description' => 'Trendy fashion for everyone',
        ]);

        echo "Businesses created successfully!\n";
    }
}