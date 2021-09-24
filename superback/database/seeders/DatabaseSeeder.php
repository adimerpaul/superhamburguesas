<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AgenciaSeeder::class,
           UserSeeder::class,
            ClienteSeeder::class,
            RubroSeeder::class,
            ProductoSeeder::class,
            GrupoSeeder::class,
            IngredienteSeeder::class,

        ]);
    }
}
