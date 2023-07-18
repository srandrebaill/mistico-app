<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialistaDisponibilidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('especialista_disponibilidades')->insert(
            array(
                ['diadasemana' => 'Segunda-Feira'],
                ['diadasemana' => 'Terça-Feira'],
                ['diadasemana' => 'Quarta-Feira'],
                ['diadasemana' => 'Quinta-Feira'],
                ['diadasemana' => 'Sexta-Feira'],
                ['diadasemana' => 'Sábado'],
                ['diadasemana' => 'Domingo']
            )
        );
    }
}
