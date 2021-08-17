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
            ["nombre"=>"PIERNA","grupoingrediente_id"=>"1"],
            ["nombre"=>"PECHO","grupoingrediente_id"=>"1"],
            ["nombre"=>"ALA","grupoingrediente_id"=>"1"],
            ["nombre"=>"FRUTILLA","grupoingrediente_id"=>"2"],
            ["nombre"=>"VAINILLA","grupoingrediente_id"=>"2"],
            ["nombre"=>"DULCE DE LECHE","grupoingrediente_id"=>"2"],
            ["nombre"=>"OSO CREMOSO","grupoingrediente_id"=>"2"],
            ["nombre"=>"CHICLE","grupoingrediente_id"=>"2"],
            ["nombre"=>"SNICKER","grupoingrediente_id"=>"2"],
            ["nombre"=>"MANDARINA","grupoingrediente_id"=>"2"],
            ["nombre"=>"MOCA","grupoingrediente_id"=>"2"],
            ["nombre"=>"CANELA","grupoingrediente_id"=>"2"],
            ["nombre"=>"PISTACHO","grupoingrediente_id"=>"2"],
            ["nombre"=>"CHOCOLATE","grupoingrediente_id"=>"2"],
            ["nombre"=>"CHIRIMOYA","grupoingrediente_id"=>"2"],
            ["nombre"=>"GRANIZADO","grupoingrediente_id"=>"2"],
            ["nombre"=>"LIMON","grupoingrediente_id"=>"2"],
            ["nombre"=>"PAI DE LIMON","grupoingrediente_id"=>"2"],
            ["nombre"=>"KIWI","grupoingrediente_id"=>"2"],
            ["nombre"=>"MORA","grupoingrediente_id"=>"2"],
            ["nombre"=>"PASAS AL RON","grupoingrediente_id"=>"2"],
            ["nombre"=>"COCO","grupoingrediente_id"=>"2"],
            ["nombre"=>"MANJAR CON NUEZ","grupoingrediente_id"=>"2"],
            ["nombre"=>"CAPUCHINO","grupoingrediente_id"=>"2"],
            ["nombre"=>"MARACUYA","grupoingrediente_id"=>"2"],
            ["nombre"=>"OREJON","grupoingrediente_id"=>"2"],
            ["nombre"=>"TUMBO","grupoingrediente_id"=>"2"],
            ["nombre"=>"DURAZNO","grupoingrediente_id"=>"2"],
            ["nombre"=>"NUEZ","grupoingrediente_id"=>"2"],
            ["nombre"=>"CHOOCOLATE BLANCO","grupoingrediente_id"=>"2"],
            ["nombre"=>"QUESO","grupoingrediente_id"=>"3"],
            ["nombre"=>"HUEVO","grupoingrediente_id"=>"3"],
            ["nombre"=>"HOT DOG","grupoingrediente_id"=>"3"],
            ["nombre"=>"JAMON","grupoingrediente_id"=>"3"],
            ["nombre"=>"TOCINO","grupoingrediente_id"=>"3"],
            ["nombre"=>"TE ","grupoingrediente_id"=>"4"],
            ["nombre"=>"CAFE ","grupoingrediente_id"=>"4"],
            ["nombre"=>"TE c/LECHE","grupoingrediente_id"=>"4"],
            ["nombre"=>"CAFE c/LECHE","grupoingrediente_id"=>"4"],
            ["nombre"=>"JUGO","grupoingrediente_id"=>"4"],
        ]);
    }
}
