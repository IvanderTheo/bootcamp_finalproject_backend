<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('cart_items')->truncate();
        DB::table('reviews')->truncate();
        DB::table('products')->truncate();
        DB::table('product_categories')->truncate();
        DB::table('tables')->truncate();
        DB::table('users')->truncate();
        DB::table('store_locations')->truncate();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            TableSeeder::class,
            LocationSeeder::class,
        ]);
    }
}
