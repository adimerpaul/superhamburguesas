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
            ["nombre"=>"BEBIDAS"],//2
            ["nombre"=>"MASAS DULCES"],
            ["nombre"=>"MASAS SALADAS"],
            ["nombre"=>"TORTAS"],
            ["nombre"=>"JUGOS"],//6
            ["nombre"=>"GASEOSAS"],//7
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
