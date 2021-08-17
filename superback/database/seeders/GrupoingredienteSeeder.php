<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoingredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grupoingredientes')->insert([
            ["nombre"=>"POLLO"],
            ["nombre"=>"HELADO"],
            ["nombre"=>"GRILL"],
            ["nombre"=>"DESAYUNO"],
        ]);
        
    }
}
