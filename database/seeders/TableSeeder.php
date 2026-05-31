<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [];
        for($i = 1;$i<=20;$i++) {
            $table_number=$i;
            $capacity = rand(1,4);
            $status = 'available';
            $input = [
                'table_number'=>$table_number,
                'capacity'=>$capacity,
                'status'=>$status
            ];
            array_push($data,$input);
        }
        DB::table('tables')->insert($data);
    }
}
