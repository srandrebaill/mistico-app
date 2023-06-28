<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            [
                'titulo' => 'Administrador',
                'permissoes' => '{"1":{"4":{"other":"on"},"5":{"view":"on","add":"on","edit":"on","delete":"on"},"2":{"view":"on","add":"on","edit":"on","delete":"on"},"3":{"view":"on","add":"on","edit":"on","delete":"on"}}}'

            ],
            [
                'titulo' => 'Revenda',
                'permissoes' => '{"6":{"7":{"view":"on","add":"on","edit":"on","delete":"on"},"8":{"view":"on","add":"on","edit":"on","delete":"on"}},"1":{"4":{"other":"on"}}}'
            ]
        );

        DB::table('usuarios_niveis')->insert(
            $data
        );
    }
}
