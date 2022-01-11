<?php

namespace App\Http\Controllers;

use App\Models\CarritoUsuario;
use App\Models\metodoPago;
use App\Models\pedidosUsuario;
use App\Models\Producto;
use Illuminate\Http\Request;

class verificaPedido extends Controller
{
    public function finalizarPedido(Request $datos)
    {


        $datos->validate([
            'noTarjeta' => 'required|numeric|digits:16'
        ]);
        $datos->validate([
            'titular' => 'required|alpha|'
        ]);
        $datos->validate([
            'cvv' => 'required|numeric|digits:3'
        ]);

        //subir datos a la tabla metodo_pago

        $usoTarjeta = new metodoPago();
        $usoTarjeta->titular = $datos->titular;
        $usoTarjeta->no_tarjeta = $datos->noTarjeta;
        $usoTarjeta->expira = $datos->fecha;
        $usoTarjeta->cvv = $datos->cvv;
        $usoTarjeta->save();

        //subir datos a la tabla pedidos_usaurio
        $idUser = session('usuario')->id_usuario;
        $findIdCard = metodoPago::where('titular', $datos->titular)->where('no_tarjeta', $datos->noTarjeta)->where('cvv', $datos->cvv)->first();
        $findItems = CarritoUsuario::where('id_usuario', $idUser)->get();
        $idProducts = array();
        $nameProducts = array();
        $productsPrices = array();
        $howMany = array();
        foreach ($findItems as $uso) {
            $idProducts[] = $uso->id_producto;
            $nameProducts[] = $uso->nombre_producto;
            $productsPrices[] = $uso->total;
            $howMany[] = $uso->cantidad;
        }

        //eliminar carrito
        foreach ($findItems as $uso){

            $deleteItem = CarritoUsuario::find($uso->id_carrito_usuario);
            $deleteItem->delete();

        }


       for ($i=0; $i<count($howMany); $i++) {

            $usoPedidos_usuario = new pedidosUsuario();
            $idCard = $findIdCard->id_metodo_pago;
            $usoPedidos_usuario->id_usuario = $idUser;
            $usoPedidos_usuario->id_producto = $idProducts[$i];
            $usoPedidos_usuario->nombre_producto = $nameProducts[$i];
            $usoPedidos_usuario->precio = $productsPrices[$i];
            $usoPedidos_usuario->cantidad = $howMany[$i];
            $usoPedidos_usuario->id_metodo_pago = $idCard;
            $usoPedidos_usuario->direccion = $datos->direccion;
            $usoPedidos_usuario->save();

        }

        return view("pagoFinalizado");
    }
}
