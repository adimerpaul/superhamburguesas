<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rubros')->insert([
            ["nombre"=>"PANES"],
            ["nombre"=>"BEBIDAS"],
            ["nombre"=>"MASAS DULCES"],
            ["nombre"=>"MASAS SALADAS"],
            ["nombre"=>"TORTAS"],
            ["nombre"=>"JUGOS"],
            ["nombre"=>"GASEOSAS"],
            ["nombre"=>"HAMBURGUESAS"],
            ["nombre"=>"POLLOS"],
            ["nombre"=>"AGVARIOS"],
            ["nombre"=>"HELADOS"],
            ["nombre"=>"FLANES O GELATINAS"],
            ["nombre"=>"COMIDA RAPIDA"],
            ["nombre"=>"ALMUERZO"],
            ["nombre"=>"JUGUETES"],
        ]);
    }
}
