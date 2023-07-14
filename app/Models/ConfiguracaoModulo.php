<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ConfiguracaoUsuarioNiveis;

use Illuminate\Support\Facades\Session;




class ConfiguracaoModulo extends Model
{
    use HasFactory;
   
    protected $table = "modulos";



    // Por padrão o laravel requer para as o campo de chave primaria o nome
    // ID, porem quando se quer utilizar um nome diferente se faz necessário 
    // aplicar a regra a baixo.
    protected $primaryKey = 'id';

    // Com esta proteção permite que somente os campos identificados no array
    // serão manipulados.
    protected $fillable =   [
        'id_modulo',
        'titulo',
        'posicao',
        'url_amigavel',
        'icone',
        'tipo_de_acao',
        'created_at', 
        'updated_at',
        'deleted_at' 
    ];  




    static function get_modulos()
    {

        $modulos = DB::table('modulos')->where('modulo_id', 0)->orderBy('posicao', 'ASC')->get();
        foreach($modulos as &$module){

            $module->submodulos = DB::table('modulos')
                                        ->where('modulo_id', $module->id)
                                        ->orderBy('posicao', 'ASC')
                                        ->get();
        }


        return $modulos;
    }


    static function get_modulos_permitidos()
    {


        $permissoes = json_decode((ConfiguracaoUsuarioNiveis::find(1))->permissoes);  

            if(count((array)$permissoes)==0){
                return [];
            } else {
                foreach ($permissoes as $id_modulo => $p) {
                    $modulo[$id_modulo] = ConfiguracaoModulo::orderBy('posicao', 'ASC')->find($id_modulo)->toArray();
                    foreach ($p as $id_sub_modulo => $submodulo) {
                        $modulo[$id_modulo]['submodulo'][] = ConfiguracaoModulo::orderBy('posicao', 'ASC')->find($id_sub_modulo)->toArray();
                    }
                }

                return $modulo;
            }

        

       
    }

    
}
