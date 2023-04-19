<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,"index"])->name("index");

Route::get('paginaPrincipal1/paginaPrincipal2',[HomeController::class,"index2"])->name("index2");


Route::get('mostrarProducto/{id}',[HomeController::class,"mostrar"])->name('mostrarProducto');

Route::get("/guiaTallas/{id}/{categoria}",[HomeController::class,"guiaTallas"])->name("guiaTallas");

Route::post('storeComprobante',[HomeController::class,"storeComprobante"])->name('storeComprobante');

Route::post('storeComprobanteAccesorios',[HomeController::class,"storeComprobanteAccesorios"])->name('storeComprobanteAccesorios');


Route::get('mostrar/factura/tenis/{id}',[HomeController::class,"vistaComprobante"])->name("factura");

Route::get('mostrar/factura/accesorios/{comprobante}/{tenis}/{nombre}/{cedula}/{telefono}/{correo}/{direccion}/{precio}/{categoria}',[HomeController::class,"vistaComprobanteAccesorios"])->name("facturaAccesorios");

Route::get("vista/login/niko",[HomeController::class,"vistaLogin"])->name("vistaLogin");

Route::post("/loginAuth",[HomeController::class,"loginAuth"])->name("loginAuth");

Route::get("/inventario",[HomeController::class,"inventario"])->name("inventario")->middleware("auth");

Route::get("/inventarioAccesorios",[HomeController::class,"inventarioAccesorios"])->name("inventarioAccesorios")->middleware("auth");

Route::post("deslogeo",[HomeController::class,"logout"])->name("logout");

Route::post("/storeTenis",[HomeController::class,"storeTenis"])->name("storeTenis")->middleware("auth");

Route::post("/storeAccesorios",[HomeController::class,"storeAccesorios"])->name("storeAccesorios")->middleware("auth");


Route::get("/vistaCrearCategoria",[HomeController::class,"vistaCrearCategoria"])->name("vistaCrearCategoria")->middleware("auth");

Route::get("/vistaCrearCategoriaAccesorios",[HomeController::class,"vistaCrearCategoriaAccesorios"])->name("vistaCrearCategoriaAccesorios")->middleware("auth");


Route::post("/storeCategoria",[HomeController::class,"storeCategoria"])->name("storeCategoria")->middleware("auth");

Route::post("/storeCategoriaAccesorios",[HomeController::class,"storeCategoriaAccesorios"])->name("storeCategoriaAccesorios")->middleware("auth");


Route::get("/vistaCrearTalla",[HomeController::class,"vistaCrearTalla"])->name("vistaCrearTalla")->middleware("auth");

Route::post("/storeVistaCrearTalla",[HomeController::class,"storeVistaCrearTalla"])->name("storeVistaCrearTalla")->middleware("auth");

Route::post("/storeVistaCrearTallaAccesorios",[HomeController::class,"storeVistaCrearTallaAccesorios"])->name("storeVistaCrearTallaAccesorios")->middleware("auth");

Route::get("/articulosNuevasTallas",[HomeController::class,"articulosNuevasTallas"])->name("articulosNuevasTallas")->middleware("auth");

Route::delete("/eliminarArticulo",[HomeController::class,"eliminarArticulo"])->name("eliminarArticulo")->middleware("auth");

Route::delete("/eliminarArticulo2",[HomeController::class,"eliminarArticulo2"])->name("eliminarArticulo2")->middleware("auth");


Route::delete("/eliminarArticuloAccesorios",[HomeController::class,"eliminarArticuloAccesorios"])->name("eliminarArticuloAccesorios")->middleware("auth");

Route::delete("/eliminarCategoria",[HomeController::class,"eliminarCategoria"])->name("eliminarCategoria")->middleware("auth");

Route::delete("/eliminarCategoriaAccesorios",[HomeController::class,"eliminarCategoriaAccesorios"])->name("eliminarCategoriaAccesorios")->middleware("auth");

Route::get("/politicas",[HomeController::class,"politicas"])->name("politicas");





