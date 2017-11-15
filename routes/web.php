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
//
// Route::get('/', function () {
//     return view('ventas');
// });
//

Route::get('/', 'VentaController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Producto
Route::resource('productos', 'ProductoController');
Route::get('productos', 'ProductoController@index')->name('productoindex');

//Venta
Route::resource('ventas', 'VentaController');
Route::get('ventas', 'VentaController@index')->name('ventaindex');
Route::get('venta/cuadrarcaja', ['uses' => 'VentaController@cuadrarCaja'])->name('cuadrarcajaventa');

//Ws Routes
Route::get('api-v1/save-venta', 'WsGiraffeController@saveVenta')->name('saveVenta');

//Personal
Route::resource('personals', 'PersonalController');
Route::get('personals', 'PersonalController@index')->name('personalindex');

//Cliente
Route::resource('clientes', 'ClienteController');
Route::get('clientes', 'ClienteController@index')->name('clienteindex');
