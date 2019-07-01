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

// Route::get('/', function () {
//      return view('principal/contenido');
// });

Route::resource('/categorias', 'CategoriaController');

Route::get('/{vue_capture?}', function () {
     return view('principal/contenido');
 })->where('vue_capture', '[\/\w\.-]*');

// //Mostrar una ruta limpia
// Route::get('/usr/{id}', function ($id) {
//     return "Mostrando ID del usuario {$id}";
// })->where('id','[0-9]+');

//Ruta plantilla principal con setion & yield
// Route::get('/', function () {
//     return view('principal/contenido');
// });
/*
Route::get('/articulos', function () {
    return view('principal/articulos');
});

Route::get('/ingresos', function () {
    return view('principal/ingresos');
});

Route::get('/proveedores', function () {
    return view('principal/proveedores');
});

Route::get('/ventas', function () {
    return view('principal/ventas');
});

Route::get('/clientes', function () {
    return view('principal/clientes');
});

Route::get('/usuarios', function () {
    return view('principal/usuarios');
});

Route::get('/roles', function () {
    return view('principal/roles');
});

Route::get('/reporteIngresos', function () {
    return view('principal/reporteIngresos');
});

Route::get('/reporteVentas', function () {
    return view('principal/reporteVentas');
});

Route::get('/login', function () {
    return view('login');
});
*/

// Route::get('/', 'ControladorPrincipal@index');

// Route::get('/', 'UserController@index');