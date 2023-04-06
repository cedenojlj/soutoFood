<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'name' => 'pepe mujica',
            'email' => 'pepe@gmail.com',
            'email2' => 'pepe2@gmail.com',
            'emailRep' => 'pepeRep@gmail.com',
            'pin' => 1234,                     
        ]);

        DB::table('customers')->insert([
            'name' => 'juan oviedo',
            'email' => 'juan@gmail.com',
            'email2' => 'juan2@gmail.com',
            'emailRep' => 'juanRep@gmail.com',
            'pin' => 1234,                     
        ]);

        DB::table('customers')->insert([
            'name' => 'hector guerra',
            'email' => 'hector@gmail.com',
            'email2' => 'hector2@gmail.com',
            'emailRep' => 'hectorRep@gmail.com',
            'pin' => 1234,                     
        ]);
    }
}
