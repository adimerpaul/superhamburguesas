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
            ["nombre"=>"BEBIDAS"],
            ["nombre"=>"CAFE CALIENTE"],
            ["nombre"=>"CAFE FRIO"],
            ["nombre"=>"CAFE CON LICOR"],

            ["nombre"=>"JUGOS"],
            ["nombre"=>"JARRA"],
            ["nombre"=>"GASEOSAS"],

            ["nombre"=>"DESAYUNOS"],
            ["nombre"=>"OMELETTES"],
            ["nombre"=>"HELADOS"],
            ["nombre"=>"HELADO CLASICO"],
            ["nombre"=>"CHOCOMANIA"],
            ["nombre"=>"ICE BRINDYS"],
            ["nombre"=>"HELADO SABORES"],

            ["nombre"=>"COMIDA RAPIDA"],
            ["nombre"=>"PIZZAS"],
            ["nombre"=>"GRILL"],
            ["nombre"=>"HAMBURGUESAS"],
            ["nombre"=>"PLATOS"],
            ["nombre"=>"ENSALADAS"],
            ["nombre"=>"SANDWICHS"],

            ["nombre"=>"MASAS DULCES"],
            ["nombre"=>"MASAS SALADAS"],

            ["nombre"=>"TORTAS"],
            ["nombre"=>"POSTRES"],

            ["nombre"=>"ALMUERZO"],

            ["nombre"=>"JUGUETES"],
        ]);
    }
}
