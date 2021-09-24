<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'cinit'=>"1010",
                'nombre'=>"Administrador",
                'telefono'=>"69603027",
                'direccion'=>"Calle x",
                'lat'=>"-17.9704",
                'lng'=>"-67.1139",
                'user_id'=>"1",
            ]
        ]);
    }
}
