<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userId = Str::uuid()->toString();
        DB::table('users')->insert([
            [
                'id'=>$userId,
                'name'=>'test',
                'email'=>'test2@gmail.com',
                'role'=>'user',
                'password'=>'test123456789',
            ]
        ]);
        $data = [];
        for($i= 0;$i<=100;$i++) {
            $product_id=rand(1,10);
            $star = rand(1,5);
            $comment = "";
            if($product_id===1) {
                $comment = "ini adalah comment tech $i";
            } else {
                $comment = "ini adalah comment biasa $i";
            }
            $input = [
                'user_id' => $userId,
                'product_id' => $product_id,
                'star'=>$star,
                'comment' => $comment,
                'created_at' => now(),
            ];
            array_push($data, $input);
        }
        DB::table('reviews')->insert($data);
    }
}
