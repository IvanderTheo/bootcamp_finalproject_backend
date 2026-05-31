<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [];
        for($i = 0;$i<50;$i++) {
            $category_id = rand(1,2);
            $name = $category_id === 1
            ? "product makanan"
            : "product minuman";
            $sku = "PRDCTS-" . Str::upper(Str::random(8));
            $description = $category_id === 1
                ? "deskripsi makanan"
                : "deskripsi minuman";
            $price = rand(10000,1000000);
            $status='active';
            $input = [
                'category_id'=>$category_id,
                'product_name'=>"$name {$i}",
                'description'=>"$description {$i}",
                'sku'=>$sku,
                'price'=>$price,
                'image_url' => "https://picsum.photos/seed/" . Str::random(10) . "/640/480",
                'status'=>$status,
                'created_at'=>now(),
            ];
            array_push($data,$input);
        }
        DB::table('products')->insert($data);
    }
}
