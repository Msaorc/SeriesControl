<?php
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

Route::get('/', function(){
    return redirect('/entrar');
});
//esta maneira e possivel fazer mas na documentação das controllers mostra da forma descomentada
// Route::get('/suplementos', 'SuplementosController@getSuplementos');
// Route::resource('suplementos', 'SuplementosController');
Route::get('/suplementos', 'SuplementosController@index')->name('listar_suplementos');

// Route::get('/suplementos', 'SuplementosController@index')->name('listar_suplementos')->middleware('auth'));
Route::get('/suplementos/adicionar', 'SuplementosController@create')->name('form_adicionar_suplementos')->middleware('marcaoauth');
Route::post('/suplementos/adicionar', 'SuplementosController@store')->middleware('marcaoauth');
Route::delete('/suplementos/{id}', 'SuplementosController@destroy')->middleware('marcaoauth');
Route::post('/suplementos/{id}/editarSuplemento', 'SuplementosController@edit')->middleware('marcaoauth');

// Route::get('/series', 'Ser-iesController@listarDesenhos');
// Route::resource('series', 'SeriesController');
Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/adicionar', 'SeriesController@create')->name('form_adicionar_series')->middleware('marcaoauth');
Route::post('/series/adicionar', 'SeriesController@store')->middleware('marcaoauth');
Route::delete('/series/remover/{id}', 'SeriesController@destroy')->middleware('marcaoauth');
Route::post('/series/{id}/editarNome', 'SeriesController@edit')->middleware('marcaoauth');

// epsodios

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->middleware('marcaoauth');;

Route::get('/series/{id}/temporadas', 'TemporadasController@index');
Route::get('/suplementos/{id}/tipos', 'TiposController@index');

Auth::routes();
// Route::resource

Route::get('/home', 'HomeController@index')->name('homeAntiga');
Route::get('/entrar', 'EntrarController@index')->name('home');
Route::post('/entrar', 'EntrarController@entrar')->name('entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});
