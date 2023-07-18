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
                'permissoes' => '{"1":{"2":{"view":"on","add":"on","edit":"on","delete":"on"},"3":{"view":"on","add":"on","edit":"on","delete":"on"},"4":{"view":"on","add":"on","edit":"on","delete":"on"}},"5":{"6":{"view":"on","add":"on","edit":"on","delete":"on"},"7":{"view":"on","add":"on","edit":"on","delete":"on"}},"8":{"10":{"view":"on","add":"on","edit":"on","delete":"on"},"9":{"view":"on","add":"on","edit":"on","delete":"on"},"11":{"view":"on","add":"on","edit":"on","delete":"on"}},"12":{"13":{"other":"on"}}}'

            ],
            [
                'titulo' => 'Revenda',
                'permissoes' => ''
            ]
        );

        DB::table('usuarios_niveis')->insert(
            $data
        );
    }
}
