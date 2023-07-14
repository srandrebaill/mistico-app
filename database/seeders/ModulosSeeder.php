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
            /** Configurações */
            [
                'modulo_id' => 0,
                'titulo' => 'Configurações',
                'posicao' => 1,
                'url_amigavel' => 'configuracao',
                'icone' => 'mdi mdi-cogs',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL
            ], [
                'modulo_id' => 1,
                'titulo' => 'Tipos de Usuário',
                'posicao' => 1,
                'url_amigavel' => 'configuracao/usuario_tipo',
                'icone' => 'mdi mdi-account-child',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' =>  NULL,
                'deleted_at' => null
            ], [
                'modulo_id' => 1,
                'titulo' => 'Usuários',
                'posicao' => 2,
                'url_amigavel' => 'configuracao/usuario',
                'icone' => '', 'tipo_de_acao' =>
                'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], [
                'modulo_id' => 1,
                'titulo' => 'Módulos',
                'posicao' => 3,
                'url_amigavel' => 'configuracao/modulo',
                'icone' => NULL,
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], 
            
            /** Cadastros */
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
            ], [
                'modulo_id' => 5,
                'titulo' => 'Clientes',
                'posicao' => 2,
                'url_amigavel' => 'cadastro/cliente',
                'icone' => 'mdi mdi-account-arrow-up',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], [
                'modulo_id' => 5,
                'titulo' => 'Pacotes',
                'posicao' => 3,
                'url_amigavel' => 'cadastro/pacote',
                'icone' => 'mdi mdi-account-convert-outline',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], 
            
            
            
            [
                'modulo_id' => 0,
                'titulo' => 'Especialistas',
                'posicao' => 1,
                'url_amigavel' => 'especialista',
                'icone' => 'mdi mdi-account-multiple-check-outline',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], [
                'modulo_id' => 8,
                'titulo' => 'Especialista',
                'posicao' => 2,
                'url_amigavel' => 'especialista/cadastro',
                'icone' => 'mdi mdi-account-outline',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null
            ], [
                'modulo_id' => 8,
                'titulo' => 'Atendimentos',
                'posicao' => 1,
                'url_amigavel' => 'especialista/atendimento',
                'icone' => 'mdi mdi-cellphone-nfc',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ], [
                'modulo_id' => 8,
                'titulo' => 'Vendas',
                'posicao' => 3,
                'url_amigavel' => 'especialista/venda',
                'icone' => 'mdi mdi-account-cash',
                'tipo_de_acao' => 'view,add,edit,delete',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],

            /** Vendas */
            [
                'modulo_id' => 0,
                'titulo' => 'Plataforma',
                'posicao' => 2,
                'url_amigavel' => 'plataforma',
                'icone' => 'mdi mdi-network-pos',
                'tipo_de_acao' => 'other',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => null
            ],
            [
                'modulo_id' => 12,
                'titulo' => 'Configurações',
                'posicao' => 1,
                'url_amigavel' => 'plataforma/configuracao',
                'icone' => 'mdi mdi-cash-register',
                'tipo_de_acao' => 'other',
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
