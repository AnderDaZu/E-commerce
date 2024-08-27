<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        if ( Storage::directoryExists('public/products') )
        {
            Storage::deleteDirectory('public/products');    
        }

        Storage::makeDirectory('public/products/');

        Product::factory(50)->create();
    }
}
