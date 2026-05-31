<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [];
        for ($i = 0;$i<3;$i++) {
            $name = "location {$i}";
            $maps = 'https://www.google.com/maps' . Str::random(10) . "/640/480";
            $input = [
                'name' =>$name,
                'maps' => $maps,
                'image_url' => "https://picsum.photos/seed/" . Str::random(10) . "/640/480",
            ];
            array_push($data,$input);
        }
        DB::table('store_locations')->insert($data);
    }
}
