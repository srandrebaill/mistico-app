<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialistaEspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('especialista_especialidade')->insert(
            ['titulo' => 'Ajuda terapêutica'],
            ['titulo' => 'Astrologia'],
            ['titulo' => 'Baralho Cigano'],
            ['titulo' => 'Baralho do Sol'],
            ['titulo' => 'Buzios'],
            ['titulo' => 'Cabala'],
            ['titulo' => 'Cartas Ciganas'],
            ['titulo' => 'Cartomancia Tradicional'],
            ['titulo' => 'Cromoterapia'],
            ['titulo' => 'Cura Quântica'],
            ['titulo' => 'Dados Ciganos'],
            ['titulo' => 'I-Ching'],
            ['titulo' => 'Mandala Cigana'],
            ['titulo' => 'Mapa Astral'],
            ['titulo' => 'Mediunidade'],
            ['titulo' => 'Mesa Radiónica'],
            ['titulo' => 'Numerologia'],
            ['titulo' => 'Pêndulo'],
            ['titulo' => 'Petit Lenormand'],
            ['titulo' => 'Radiestesia'],
            ['titulo' => 'Reiki'],
            ['titulo' => 'Relacionamento'],
            ['titulo' => 'Runas'],
            ['titulo' => 'Tarô'],
            ['titulo' => 'Tarot'],
            ['titulo' => 'Tarot Celta'],
            ['titulo' => 'Tarot das Bruxas'],
            ['titulo' => 'Tarot de Crowley'],
            ['titulo' => 'Tarot de Marselha'],
            ['titulo' => 'Tarot do Amor'],
            ['titulo' => 'Tarot dos Anjos'],
            ['titulo' => 'Tarot dos Orixás'],
            ['titulo' => 'Tarot Egípcio'],
            ['titulo' => 'Tarot Mitológico'],
            ['titulo' => 'Tarot Rider Waite'],
            ['titulo' => 'Terapia Holística'],
            ['titulo' => 'Vidência']
        );
    }
}
