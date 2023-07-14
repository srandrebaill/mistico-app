<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\
    {
        ConfiguracaoUsuarioTipoController, 
        ConfiguracaoUsuarioController, 
        ConfiguracaoModuloController, 
        DashboardController, 
        LoginController,
        PlanoController,
        ClienteController,
        VendaController,
        PaymentController
    };

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('dashboard', [LoginController::class, 'dashboard']);
Route::post('login-action', [LoginController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');






Route::get('saque', [DashboardController::class, 'index'])->name('saque');


/* Grupo de Rotas Autenticadas */
Route::group(['middleware' => 'auth'], function () {

    /* Tipos de Usuário */
    Route::get('configuracao/usuario_tipo',                 [ConfiguracaoUsuarioTipoController::class, 'index'])->name('usuario_tipo');
    Route::get('configuracao/usuario_tipo/editar/{id?}',    [ConfiguracaoUsuarioTipoController::class, 'edit'])->name('usuario_tipo.editar');
    Route::get('configuracao/usuario_tipo/adicionar',       [ConfiguracaoUsuarioTipoController::class, 'create'])->name('usuario_tipo.adicionar');
    Route::post('configuracao/usuario_tipo/store',          [ConfiguracaoUsuarioTipoController::class, 'store'])->name('usuario_tipo.store');
    Route::post('configuracao/usuario_tipo/update/{id}',    [ConfiguracaoUsuarioTipoController::class, 'update'])->name('usuario_tipo.update');

    /* Usuários */
    Route::get('configuracao/usuario',                      [ConfiguracaoUsuarioController::class, 'index'])->name('usuario');
    Route::get('configuracao/usuario/editar/{id?}',         [ConfiguracaoUsuarioController::class, 'edit'])->name('usuario.editar');
    Route::get('configuracao/usuario/adicionar',            [ConfiguracaoUsuarioController::class, 'create'])->name('usuario.adicionar');
    Route::post('configuracao/usuario/store',               [ConfiguracaoUsuarioController::class, 'store'])->name('usuario.store');
    Route::post('configuracao/usuario/update/{id}',         [ConfiguracaoUsuarioController::class, 'update'])->name('usuario.update');

    /* Módulos */
    Route::get('configuracao/modulo',                       [ConfiguracaoModuloController::class, 'index'])->name('modulo');
    Route::get('configuracao/modulo/editar/{id?}',          [ConfiguracaoModuloController::class, 'edit'])->name('modulo.editar');
    Route::get('configuracao/modulo/adicionar',             [ConfiguracaoModuloController::class, 'create'])->name('modulo.adicionar');
    Route::post('configuracao/modulo/store',                [ConfiguracaoModuloController::class, 'store'])->name('modulo.store');
    Route::post('configuracao/modulo/update/{id}',          [ConfiguracaoModuloController::class, 'update'])->name('modulo.update');



    /* Planos */
    Route::get('cadastro/plano',                                  [PlanoController::class, 'index'])->name('plano');
    Route::get('cadastro/plano/editar/{id?}',                     [PlanoController::class, 'edit'])->name('plano.editar');
    Route::get('cadastro/plano/adicionar',                        [PlanoController::class, 'create'])->name('plano.adicionar');
    Route::post('cadastro/plano/store',                           [PlanoController::class, 'store'])->name('plano.store');
    Route::post('cadastro/plano/update/{id}',                     [PlanoController::class, 'update'])->name('plano.update');


    /* Clientes */
    Route::get('cadastro/cliente',                                [ClienteController::class, 'index'])->name('cliente');
    Route::get('cadastro/cliente/editar/{id?}',                   [ClienteController::class, 'edit'])->name('cliente.editar');
    Route::get('cadastro/cliente/adicionar',                      [ClienteController::class, 'create'])->name('cliente.adicionar');
    Route::post('cadastro/cliente/store',                         [ClienteController::class, 'store'])->name('cliente.store');
    Route::post('cadastro/cliente/update/{id}',                   [ClienteController::class, 'update'])->name('cliente.update');


    
});
