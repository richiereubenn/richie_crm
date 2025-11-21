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

        $sales1 = User::create([
            'username' => 'sales1',
            'password' => Hash::make('sales123'),
            'role' => 'Sales',
        ]);

        $sales2 = User::create([
            'username' => 'sales2',
            'password' => Hash::make('sales123'),
            'role' => 'Sales',
        ]);

        $product1 = Product::create([
            'name' => 'Basic Internet Plan',
            'description' => 'Home internet plan with up to 30 Mbps speed.',
            'price' => 150000,
            'subscription_period' => 30,
        ]);

        $product2 = Product::create([
            'name' => 'Family Internet Plan',
            'description' => 'Internet plan up to 50 Mbps, ideal for streaming and multiple devicet.',
            'price' => 250000,
            'subscription_period' => 30,
        ]);

        $product3 = Product::create([
            'name' => 'Gamer Pro Plan',
            'description' => 'High-performance ISP plan with 100 Mbps speed.',
            'price' => 400000,
            'subscription_period' => 30,
        ]);

        $product4 = Product::create([
            'name' => 'Business Fiber Plan',
            'description' => 'Dedicated fiber connection up to 200 Mbps.',
            'price' => 750000,
            'subscription_period' => 30,
        ]);

        $product5 = Product::create([
            'name' => 'Enterprise Dedicated Plan',
            'description' => 'Enterprise-grade dedicated internet with up to 500 Mbps speed.',
            'price' => 1500000,
            'subscription_period' => 30,
        ]);



    }
}
