<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\
    {
        ConfiguracaoUsuarioTipoController, 
        ConfiguracaoUsuarioController, 
        ConfiguracaoModuloController, 
        DashboardController, 
        LoginController,
    pacoteController,
        ClienteController,
    EspecialistaController,
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

    /** Tipos de Usuário */
    Route::get('configuracao/usuario_tipo', [ConfiguracaoUsuarioTipoController::class, 'index'])->name('usuario_tipo');
    Route::get('configuracao/usuario_tipo/editar/{id?}', [ConfiguracaoUsuarioTipoController::class, 'edit'])->name('usuario_tipo.editar');
    Route::get('configuracao/usuario_tipo/adicionar', [ConfiguracaoUsuarioTipoController::class, 'create'])->name('usuario_tipo.adicionar');
    Route::post('configuracao/usuario_tipo/store', [ConfiguracaoUsuarioTipoController::class, 'store'])->name('usuario_tipo.store');
    Route::post('configuracao/usuario_tipo/update/{id}', [ConfiguracaoUsuarioTipoController::class, 'update'])->name('usuario_tipo.update');

    /** Usuários */
    Route::get('configuracao/usuario', [ConfiguracaoUsuarioController::class, 'index'])->name('usuario');
    Route::get('configuracao/usuario/editar/{id?}', [ConfiguracaoUsuarioController::class, 'edit'])->name('usuario.editar');
    Route::get('configuracao/usuario/adicionar', [ConfiguracaoUsuarioController::class, 'create'])->name('usuario.adicionar');
    Route::post('configuracao/usuario/store', [ConfiguracaoUsuarioController::class, 'store'])->name('usuario.store');
    Route::post('configuracao/usuario/update/{id}', [ConfiguracaoUsuarioController::class, 'update'])->name('usuario.update');

    /** Módulos */
    Route::get('configuracao/modulo', [ConfiguracaoModuloController::class, 'index'])->name('modulo');
    Route::get('configuracao/modulo/editar/{id?}', [ConfiguracaoModuloController::class, 'edit'])->name('modulo.editar');
    Route::get('configuracao/modulo/adicionar', [ConfiguracaoModuloController::class, 'create'])->name('modulo.adicionar');
    Route::post('configuracao/modulo/store', [ConfiguracaoModuloController::class, 'store'])->name('modulo.store');
    Route::post('configuracao/modulo/update/{id}', [ConfiguracaoModuloController::class, 'update'])->name('modulo.update');

    /** Clientes */
    Route::get('cadastro/cliente', [ClienteController::class, 'index'])->name('cliente');
    Route::get('cadastro/cliente/editar/{id?}', [ClienteController::class, 'edit'])->name('cliente.editar');
    Route::get('cadastro/cliente/adicionar', [ClienteController::class, 'create'])->name('cliente.adicionar');
    Route::post('cadastro/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::post('cadastro/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');

    /** Pacotes */
    Route::get('cadastro/pacote', [pacoteController::class, 'index'])->name('pacote');
    Route::get('cadastro/pacote/editar/{id?}', [pacoteController::class, 'edit'])->name('pacote.editar');
    Route::get('cadastro/pacote/adicionar', [pacoteController::class, 'create'])->name('pacote.adicionar');
    Route::post('cadastro/pacote/store', [pacoteController::class, 'store'])->name('pacote.store');
    Route::post('cadastro/pacote/update/{id}', [pacoteController::class, 'update'])->name('pacote.update');

    /** Especialistas */
    Route::get('especialista/cadastro', [EspecialistaController::class, 'index'])->name('especialista');
    Route::get('especialista/cadastro/editar/{id?}', [EspecialistaController::class, 'edit'])->name('especialista.editar');
    Route::get('especialista/cadastro/adicionar', [EspecialistaController::class, 'create'])->name('especialista.adicionar');
    Route::post('especialista/cadastro/store', [EspecialistaController::class, 'store'])->name('especialista.store');
    Route::post('especialista/cadastro/update/{id}', [EspecialistaController::class, 'update'])->name('especialista.update');
});

Route::controller(ImageController::class)->group(function () {
    Route::get('/image-upload', 'index')->name('image.form');
    Route::post('/upload-image', 'storeImage')->name('image.store');
});
