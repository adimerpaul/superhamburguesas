<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            ["nombre"=>"PAN BOTON","rubro_id"=>1],
            ["nombre"=>"PORCION DE TOSTADA","rubro_id"=>1],
            ["nombre"=>"BEBIDAS CERVEZA HUARI 1/2","rubro_id"=>2],
            ["nombre"=>"BEBIDAS AGUA VITAL","rubro_id"=>2],
            ["nombre"=>"AGUA","rubro_id"=>2],
        ]);
    }
}
