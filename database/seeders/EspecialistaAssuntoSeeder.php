<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialistaAssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('especialista_assuntos')->insert(
            array(
                ['titulo' => 'Amor'],
                ['titulo' => 'Saúde'],
                ['titulo' => 'Dinheiro'],
                ['titulo' => 'Carreira'],
                ['titulo' => 'Família'],
                ['titulo' => 'Questões Judiciais'],
                ['titulo' => 'Autoconhecimento']
            )
        );
    }
}
