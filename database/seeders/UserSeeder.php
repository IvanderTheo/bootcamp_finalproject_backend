<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'root',
            'email'=>'root@gmail.com',
            'password'=>'root',
            'role'=>'admin'
        ]);
        User::create([
            'name'=>'root1',
            'email'=>'root1@gmail.com',
            'password'=>'root1',
            'role'=>'user'
        ]);
        User::create([
            'name'=>'root2',
            'email'=>'root2@gmail.com',
            'password'=>'root2',
            'role'=>'kasir'
        ]);
        User::create([
            'name'=>'root3',
            'email'=>'root3@gmail.com',
            'password'=>'root3',
            'role'=>'karyawan'
        ]);
    }
}
