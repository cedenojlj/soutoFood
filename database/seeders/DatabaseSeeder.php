<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Product::factory(50)->create();

        $this->call([

            UserSeeder::class,
            CustomerSeeder::class,        
        ]);
        
        Product::factory()->count(300)->create();
        Customer::factory()->count(100)->create();
        User::factory()->count(100)->create();
        

    }
}


