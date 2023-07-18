<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EspecialistaAssunto;
use App\Models\EspecialistaDisponibilidade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            NiveisSeeder::class,
            ModulosSeeder::class,
            EspecialistaAssuntoSeeder::class,
            EspecialistaDisponibilidadeSeeder::class,
            EspecialistaEspecialidadeSeeder::class,
        ]);

    }
}
