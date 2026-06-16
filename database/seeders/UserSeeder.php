<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'business_id' => 1,
            'name' => 'John Manager',
            'email' => 'manager@test.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        User::create([
            'business_id' => 1,
            'name' => 'Bob Worker',
            'email' => 'worker@test.com',
            'password' => bcrypt('password'),
            'role' => 'worker',
        ]);

        User::create([
            'business_id' => 1,
            'name' => 'Alice Worker',
            'email' => 'alice@test.com',
            'password' => bcrypt('password'),
            'role' => 'worker',
        ]);

        User::create([
            'business_id' => 2,
            'name' => 'Sarah Manager',
            'email' => 'sarah@test.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        echo "Users created successfully!\n";
    }
}