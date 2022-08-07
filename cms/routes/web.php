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
    /*return view('welcome');*/
    return view('plantilla');

});

/*enviando las rutas de las vistas /directorio /vistas */
//Route::view('/', 'paginas.blog');
//Route::view('/administradores', 'paginas.administradores');
//Route::view('/categorias', 'paginas.categorias');
//Route::view('/articulos', 'paginas.articulos');
//Route::view('/banner', 'paginas.banner');
//Route::view('/opiniones', 'paginas.opiniones');
//Route::view('/anuncios', 'paginas.anuncios');



/*creando metodo get /directorio/controlador/@metodo del controlador*/
//Route::get('/', 'BlogController@traerBlog');
/*se llama a la ruta , controlador@nombre del metodo del controlador*/

//Route::get('/administradores', 'AdministradoresController@traerAdministradores');
//Route::get('/categorias', 'CategoriasController@traerCategorias');
//Route::get('/articulos', 'ArticulosController@traerArticulos');
//Route::get('/opiniones', 'OpinionesController@traerOpiniones');
//Route::get('/anuncios', 'AnunciosController@traerAnuncios');
//Route::get('/banner', 'BannerController@traerBanner');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//RUTAS QUE INCLUYEN TODOS LOS METODOS HTTP
//Route::resource
//php artisan route:list ---se ve desde el cmd

//todos los recursos de metodo http(views, get, put, delete,post) para la pagina inicial y esos estan en mi controlador//
Route::resource('/', 'BlogController');
Route::resource('/blog', 'BlogController');
Route::resource('/administradores', 'AdministradoresController');
Route::resource('/categorias', 'CategoriasController');
Route::resource('/articulos', 'ArticulosController');
Route::resource('/opiniones', 'OpinionesController');
Route::resource('/anuncios', 'AnunciosController');
Route::resource('/banner', 'BannerController');








