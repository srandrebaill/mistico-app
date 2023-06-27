<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modulos = array(
            [
                'modulo_id' => 0,
                'titulo' => 'Configurações',
                'posicao' => 4,
                'url_amigavel' => 'configuracao',
                'icone' => 'mdi mdi-cogs',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ],
            [
                'modulo_id' => 1,
                'titulo' => 'Tipos de Usuário',
                'posicao' => 4,
                'url_amigavel' => 'admin/configuracao/usuario_tipo',
                'icone' => 'mdi mdi-account-child',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' =>  NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 1,
                'titulo' => 'Usuários',
                'posicao' => 5,
                'url_amigavel' => 'admin/configuracao/usuario',
                'icone' => '', 'tipo_de_acao' =>
                'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 1,
                'titulo' => 'SGA Configurações',
                'posicao' => 2,
                'url_amigavel' => 'admin/configuracao',
                'icone' => '',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 1,
                'titulo' => 'Módulos',
                'posicao' => 3,
                'url_amigavel' => 'admin/configuracao/modulo',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 0,
                'titulo' => 'Cadastros',
                'posicao' => 1,
                'url_amigavel' => 'cadastro',
                'icone' => 'mdi mdi-paperclip',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 6,
                'titulo' => 'Clientes',
                'posicao' => 1,
                'url_amigavel' => 'cadastro/cliente',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            [
                'modulo_id' => 6,
                'titulo' => 'Plano',
                'posicao' => 2,
                'url_amigavel' => 'cadastro/plano',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ]
        );



        DB::table('modulos')->insert(
            $modulos
        );
    }
}
