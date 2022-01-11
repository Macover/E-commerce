<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\verificaPedido;


Route::get('/', function () {
    return view('inicio');
});
Route::get('/inicio',[UsuarioController::class,'inicio'])->name('inicio');
Route::get('/login',[UsuarioController::class,'login'])->name('login');
Route::post('/login',[UsuarioController::class,'verificarCredenciales'])->name('login.form');
Route::get('/registro',[UsuarioController::class,'registro'])->name('registro');
Route::post('/registro',[UsuarioController::class,'registroForm'])->name('registro.form');
Route::get('/cerrarSesion',[UsuarioController::class,'cerrarSesion'])->name('cerrar.sesion');

Route::prefix('/usuario')->middleware("VerificarUsuario")->group(function () {

    //Route user
    Route::get('/menu/Productos', [UsuarioController::class, 'vistaProductos'])->name('vista.productos');
    Route::get('/menu/Chekouts', [CarritoController::class, 'miCarrito'])->name('mi.carrito');
    Route::post('/menu/Chekout', [CarritoController::class, 'carrito'])->name('carrito.pedidos');
    Route::post('/menu/borrarItem', [CarritoController::class, 'borrarItem'])->name('borrar.item');
    Route::post('/menu/finalizarPedido', [verificaPedido::class, 'finalizarPedido'])->name('finalizar.pedido');
    Route::get('/menu/misPedidos', [UsuarioController::class, 'vistaMisPedios'])->name('vista.mis.pedidos');


    //Route admin
    Route::get('/menuAdmin', [UsuarioController::class, 'menuAdmin'])->name('usuario.menu.admin');
    Route::get('/productosRegistrados', [ProductosController::class, 'productosRegistrados'])->name('productos.admin');
    Route::get('/pedidosRealizados', [ProductosController::class, 'pedidosRealizados'])->name('pedidos.admin');
    Route::get('/addProducto', [ProductosController::class, 'addProductos'])->name('productos.admin.add');
    Route::post('/addProductos', [ProductosController::class, 'registrarProducto'])->name('registrar.productos.admin');
    Route::get('/deleProducto/{id_producto}/', [ProductosController::class, 'eliminarProducto'])->name('eliminar.productos.admin');
});
