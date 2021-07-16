<?php

use Bredi\BrediDashboard\Http\Middleware\ValidaPermissao;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Authentication Routes...
Route::get('/login', 'BrediDashboardController@formLogin')
        ->middleware('guest', \Bredi\BrediDashboard\Http\Middleware\RedirectDashboard::class)
        ->name('bredidashboard::login'); //->as('bredidashboard::');

Route::get('/home', function(){
    return redirect()->route('bredidashboard::dashboard');
});

Route::post('/login', ['uses' => 'Auth\BrediDashboardLoginController@login', 'as' => 'login'])->middleware('guest', \Bredi\BrediDashboard\Http\Middleware\RedirectDashboard::class);

Route::get('logout', 'Auth\BrediDashboardLoginController@logout')->name('bredidashboard::logout');
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('selectload', ['uses' => 'BrediDashboardController@selectload'])->name('controle.selectload.get');

Route::prefix('dashboard')
->group(
function(){
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('bredidashboard::password.form');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('bredidashboard::sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/update', 'Auth\ResetPasswordController@reset')->name('bredidashboard::password.update');
});

Route::prefix((!empty(config('bredidashboard.prefix')) ? config('bredidashboard.prefix') : 'controle'))->middleware('auth', ValidaPermissao::class)->as('bredidashboard::')->group(function () {

    Route::get('template', function () {
        return config('bredidashboard.template');
    });
    // Password Reset Routes...
    // $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('/', ['uses' => 'BrediDashboardController@index'])->name('dashboard');
    // Route::get('/', ['uses' => 'BrediDashboardController@index', 'permissao' => 'dashboard'])->name('dashboard');

    Route::get('usuarios', ['uses' => 'UsuarioController@index', 'permissao' => 'controle.usuario.index'])->name('controle.usuario.index');
    Route::get('usuario/create', ['uses' => 'UsuarioController@create', 'permissao' => 'controle.usuario.create'])->name('controle.usuario.create');
    Route::get('usuario/edit/{id}', ['uses' => 'UsuarioController@edit', 'permissao' => 'controle.usuario.edit'])->name('controle.usuario.edit');
    Route::post('usuario/store', ['uses' => 'UsuarioController@store', 'permissao' => 'controle.usuario.store'])->name('controle.usuario.store');
    Route::post('usuario/update/{id}', ['uses' => 'UsuarioController@update', 'permissao' => 'controle.usuario.update'])->name('controle.usuario.update');
    Route::get('usuario/delete/{id}', ['uses' => 'UsuarioController@destroy', 'permissao' => 'controle.usuario.destroy'])->name('controle.usuario.destroy');

    Route::get('grupo-de-usuarios', ['uses' => 'GrupoUsuarioController@index', 'permissao' => 'controle.grupo-usuario.index'])->name('controle.grupo-usuario.index');
    Route::get('grupo-de-usuario/create', ['uses' => 'GrupoUsuarioController@create', 'permissao' => 'controle.grupo-usuario.create'])->name('controle.grupo-usuario.create');
    Route::get('grupo-de-usuario/edit/{id}', ['uses' => 'GrupoUsuarioController@edit', 'permissao' => 'controle.grupo-usuario.edit'])->name('controle.grupo-usuario.edit');
    Route::post('grupo-de-usuario/store', ['uses' => 'GrupoUsuarioController@store', 'permissao' => 'controle.grupo-usuario.store'])->name('controle.grupo-usuario.store');
    Route::post('grupo-de-usuario/update/{id}', ['uses' => 'GrupoUsuarioController@update', 'permissao' => 'controle.grupo-usuario.update'])->name('controle.grupo-usuario.update');
    Route::get('grupo-de-usuario/delete/{id}', ['uses' => 'GrupoUsuarioController@destroy', 'permissao' => 'controle.grupo-usuario.destroy'])->name('controle.grupo-usuario.destroy');

    Route::post('upload-editor', ['uses' => 'BrediDashboardController@uploadEditor', 'permissao' => 'controle.index.index'])->name('controle.summernote.upload');
    Route::post('delete-image-editor', ['uses' => 'BrediDashboardController@deleteImageEditor', 'permissao' => 'controle.index.index'])->name('controle.summernote.deleteImageEditor');

    Route::get('configuracoes/form', ['uses' => 'ConfigController@edit', 'permissao' => 'controle.config.edit'])->name('controle.config.edit');
    Route::post('configuracoes/update', ['uses' => 'ConfigController@update', 'permissao' => 'controle.config.update'])->name('controle.config.update');

    Route::get('profile/edit', ['uses' => 'ProfileController@edit'])->name('controle.profile.edit');
    Route::post('profile/update/{id}', ['uses' => 'ProfileController@update'])->name('controle.profile.update');

    Route::get('permissoes/edit', ['uses' => 'PermissaoController@edit', 'permissao' => 'controle.permissao.edit'])->name('controle.permissao.edit');
    Route::post('permissoes/update/{id?}', ['uses' => 'PermissaoController@update', 'permissao' => 'controle.permissao.update'])->name('controle.permissao.update');
    Route::get('permissoes', ['uses' => 'PermissaoController@index', 'permissao' => 'controle.permissao.index'])->name('controle.permissao.index');//Não usado. Redireciona pro edit

    Route::post('ordenacao', ['uses' => 'BrediDashboardController@ordenacaoUpdate'])->name('controle.ordenacao.update');

});

// Route::get('/restrito', ['uses' => 'BrediDashboardController@index', 'permissao' => 'index'])->middleware('auth', ValidaPermissao::class);
