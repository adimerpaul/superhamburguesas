<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencias')->insert([
            ["nombre"=>"Super hamburguesas","lat"=>"-17.9704","lng"=>"-67.1139"],
            ["nombre"=>"Super 6 de octubre","lat"=>"-17.9649","lng"=>"-67.1112"],
            ["nombre"=>"Super pagador","lat"=>"-17.9702","lng"=>"-67.1104"],
            ["nombre"=>"Super sud","lat"=>"-17.9783","lng"=>"-67.1323"],
        ]);
    }
}
