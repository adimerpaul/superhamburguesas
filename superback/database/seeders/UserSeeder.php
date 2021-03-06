<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
               'email'=>'admin@test.com',
               'name'=>'admin',
               'password'=>Hash::make('7336199'),
               'fechalimite'=>'2021-12-31',
               'celular'=>'69603027',
                'carnet'=>'7336199'
           ]
        ]);
    }
}
