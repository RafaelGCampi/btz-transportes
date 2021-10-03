<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth'], function () {

     Route::get('/home', function () {
        return view('home');
    });

   Route::get('/', function () {
        return view('home');
    });

    Route::prefix('/motorista')->name('motorista.')->group( function () {
        Route::get('/', 'MotoristaController@index')->name('index');
        Route::post('/store', 'MotoristaController@store');
        Route::get('/list', 'MotoristaController@list');
        Route::delete('/delete/{motorista}', 'MotoristaController@destroy');
        Route::get('/edit/{motorista}', 'MotoristaController@edit');
        Route::get('/form', 'MotoristaController@show');
    });

    Route::prefix('/veiculo')->name('veiculo.')->group( function () {
        Route::get('/', 'VeiculoController@index')->name('index');
        Route::post('/store', 'VeiculoController@store');
        Route::get('/list', 'VeiculoController@list');
        Route::delete('/delete/{veiculo}', 'VeiculoController@destroy');
        Route::get('/edit/{veiculo}', 'VeiculoController@edit');
        Route::get('/form', 'VeiculoController@show');
    });

    Route::prefix('/abastecimento')->name('abastecimento.')->group( function () {
        Route::get('/', 'AbastecimentoController@index')->name('index');
        Route::post('/store', 'AbastecimentoController@store');
        Route::get('/list', 'AbastecimentoController@list');
        Route::get('/edit/{abastecimento}', 'AbastecimentoController@edit');
        Route::get('/form', 'AbastecimentoController@show');
    });
});


//desabilitando registar usuarios
Auth::routes(['register' => false]);

Auth::routes();






