<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_categories')->insert([
            [
                'category_name'=>'Makanan',
                'category_slug'=>'makanan',
            ],
            [
                'category_name'=>'Minuman',
                'category_slug'=>'Minuman',
            ],
            [
                'category_name'=>'Snack',
                'category_slug'=>'snack',
            ],
        ]);
    }
}
