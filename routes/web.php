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

Route::get('venta/listaventa', ['uses' => 'VentaController@listaVenta'])->name('listaventaindex');
Route::get('venta/reporte', ['uses' => 'VentaController@orderDetail'])->name('orderDetail');

//Personal
Route::resource('personals', 'PersonalController');
Route::get('personals', 'PersonalController@index')->name('personalindex');

//Cliente
Route::resource('clientes', 'ClienteController');
Route::get('clientes', 'ClienteController@index')->name('clienteindex');

//Ingreso
Route::resource('ingresos', 'IngresoController');
Route::get('ingresos', 'IngresoController@index')->name('ingresoindex');

//Ws Routes
Route::get('api-v1/save-venta', 'WsGiraffeController@saveVenta')->name('saveVenta');
Route::get('api-v1/save-cuadrar-caja', 'WsGiraffeController@saveCuadrarCaja')->name('saveCuadrarCaja');
Route::get('api-v1/get-detalle-venta/{idVenta}', 'WsGiraffeController@getDetalleVenta')->name('getdetalleVenta');

Route::get('api-v1/get-buscarReporteVenta/{fechaInicial}/{fechaFinal}/{personalId}', 'WsGiraffeController@getReporteVenta')->name('getReporteVenta');
Route::get('api-v1/get-buscarReporteVentaPersonaId/{personalId}', 'WsGiraffeController@getReporteVentaByUserId')->name('getReporteVentaByUserId');
Route::get('api-v1/get-buscarReporteVentaDates/{fechaInicial}/{fechaFinal}', 'WsGiraffeController@getReporteVentaByDates')->name('getReporteVentaByDates');

Route::get('api-v1/get-buscarReporteVentaList/{idVenta}', 'WsGiraffeController@getDetalleVentaList')->name('getDetalleVentaList');
Route::get('api-v1/put-downloadpdf', 'WsGiraffeController@reporteVentasPdf')->name('reporteVentasPdf');

//Kardex
Route::resource('kardexs', 'KardexController');
Route::get('kardexs', 'KardexController@index')->name('kardexindex');

//Insumo
Route::resource('insumos', 'InsumoController');
Route::get('insumos', 'InsumoController@index')->name('insumoindex');
