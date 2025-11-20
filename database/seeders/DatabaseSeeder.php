<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        $manager = User::create([
            'username' => 'manager',
            'password' => Hash::make('manager123'),
            'role' => 'Manager',
        ]);

        $sales = User::create([
            'username' => 'sales',
            'password' => Hash::make('sales123'),
            'role' => 'Sales',
        ]);

        $sales2 = User::create([
            'username' => 'sales2',
            'password' => Hash::make('sales123'),
            'role' => 'Sales',
        ]);

        $ProductA = Product::create([
            'name' => 'Product A',
            'description' => 'Description for Product A',
            'price' => 100000,
            'subscription_period' => 30,
        ]);



    }
}
