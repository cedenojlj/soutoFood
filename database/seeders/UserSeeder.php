<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'siproced',
            'emailuser' => 'siproced@gmail.com', //email user
            'email' => 'siproced',               // username
            'password' => Hash::make(12345678),
            'date1'=>'2023-02-23',
            'date2'=>'2023-02-24',
            'date3'=>'2023-02-25',
            'rol'=>'admin'            
        ]);

        DB::table('users')->insert([
            'name' => 'juan',
            'emailuser' => 'juan123@gmail.com', //email user
            'email' => 'juan123',               // username
            'password' => Hash::make(12345678),
            'date1'=>'2023-02-23',
            'date2'=>'2023-02-24',
            'date3'=>'2023-02-25',
            'rol'=>'user'           
        ]);

        DB::table('users')->insert([
            'name' => 'pepe',
            'emailuser' => 'pepe123@gmail.com', //email user
            'email' => 'pepe123',               // username
            'password' => Hash::make(12345678),
            'date1'=>'2023-05-10',
            'date2'=>'2023-06-05',
            'date3'=>'2023-07-08',
            'rol'=>'user'            
        ]);

    }
}


