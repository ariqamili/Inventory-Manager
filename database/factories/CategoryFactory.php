<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Electronics', 'Clothing', 'Food & Beverages', 'Home & Garden',  'Sports & Outdoors', 
            'Books & Media', 'Toys & Games', 'Health & Beauty',  'Office Supplies', 'Automotive',
        ];
        
        return [
            'business_id' => Business::factory(),
            'name' => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence,
        ];
    }
}