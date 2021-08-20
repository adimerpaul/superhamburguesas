<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ingredientes')->insert([
            ["nombre"=>"PIERNA","grupo_id"=>"1"],
            ["nombre"=>"PECHO","grupo_id"=>"1"],
            ["nombre"=>"ALA","grupo_id"=>"1"],
            ["nombre"=>"FRUTILLA","grupo_id"=>"2"],
            ["nombre"=>"VAINILLA","grupo_id"=>"2"],
            ["nombre"=>"DULCE DE LECHE","grupo_id"=>"2"],
            ["nombre"=>"OSO CREMOSO","grupo_id"=>"2"],
            ["nombre"=>"CHICLE","grupo_id"=>"2"],
            ["nombre"=>"SNICKER","grupo_id"=>"2"],
            ["nombre"=>"MANDARINA","grupo_id"=>"2"],
            ["nombre"=>"MOCA","grupo_id"=>"2"],
            ["nombre"=>"CANELA","grupo_id"=>"2"],
            ["nombre"=>"PISTACHO","grupo_id"=>"2"],
            ["nombre"=>"CHOCOLATE","grupo_id"=>"2"],
            ["nombre"=>"CHIRIMOYA","grupo_id"=>"2"],
            ["nombre"=>"GRANIZADO","grupo_id"=>"2"],
            ["nombre"=>"LIMON","grupo_id"=>"2"],
            ["nombre"=>"PAI DE LIMON","grupo_id"=>"2"],
            ["nombre"=>"KIWI","grupo_id"=>"2"],
            ["nombre"=>"MORA","grupo_id"=>"2"],
            ["nombre"=>"PASAS AL RON","grupo_id"=>"2"],
            ["nombre"=>"COCO","grupo_id"=>"2"],
            ["nombre"=>"MANJAR CON NUEZ","grupo_id"=>"2"],
            ["nombre"=>"CAPUCHINO","grupo_id"=>"2"],
            ["nombre"=>"MARACUYA","grupo_id"=>"2"],
            ["nombre"=>"OREJON","grupo_id"=>"2"],
            ["nombre"=>"TUMBO","grupo_id"=>"2"],
            ["nombre"=>"DURAZNO","grupo_id"=>"2"],
            ["nombre"=>"NUEZ","grupo_id"=>"2"],
            ["nombre"=>"CHOOCOLATE BLANCO","grupo_id"=>"2"],
            ["nombre"=>"QUESO","grupo_id"=>"3"],
            ["nombre"=>"HUEVO","grupo_id"=>"3"],
            ["nombre"=>"HOT DOG","grupo_id"=>"3"],
            ["nombre"=>"JAMON","grupo_id"=>"3"],
            ["nombre"=>"TOCINO","grupo_id"=>"3"],
            ["nombre"=>"TE ","grupo_id"=>"4"],
            ["nombre"=>"CAFE ","grupo_id"=>"4"],
            ["nombre"=>"TE c/LECHE","grupo_id"=>"4"],
            ["nombre"=>"CAFE c/LECHE","grupo_id"=>"4"],
            ["nombre"=>"JUGO","grupo_id"=>"4"],
        ]);
    }
}
