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

Route::get('/', function () {
    return view('primera');
});

Route::get('/historia', function () {
    return view('historia');
});

Route::get('/jugadores','JugadorController@getJugadores');

Route::get('/jugador/{id}','JugadorController@getJugador');

Route::get('/partidos/{temp?}', function () {
    return view('partidos');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/compruebaLogin', 'UsuarioController@comprobarLogin');

Route::get('/logout', 'UsuarioController@logout');

Route::get('/registro', function () {
    return view('registrarse');
});

Route::post('/comprobarRegistro', 'UsuarioController@comprobarRegistro');

Route::get('/noticias','NoticiaController@getNoticias');

Route::get('/noticia/{id}','NoticiaController@getNoticia');

Route::post('/publicarComentario','NoticiaController@publicarComentario');