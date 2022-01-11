<?php

namespace App\Http\Controllers;

use App\Models\CarritoUsuario;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    public function carrito(Request $datos){

        //decodicar array
        $array = json_decode($datos->arrayAjax);
        $val = array();
        foreach ($array as $uso){
            $val[] = $uso;
        }

        $otra = array_count_values($val);

        foreach ($otra as $key => $value){

            $carrito = new CarritoUsuario();
            $precio = Producto::find($key);
            $carrito->id_usuario = session('usuario')->id_usuario;
            $carrito->nombre_producto = $precio->nombre_producto;
            $carrito->id_producto = $key;
            $carrito->cantidad = $value;
            $total = $precio->precio * $value;
            $carrito->total = $total;
            $carrito->save();

        }

        return response()->json($otra);

    }

    public function miCarrito(){

        $idUsuario = session('usuario')->id_usuario;
        $carritoUsuario = CarritoUsuario::where('id_usuario',$idUsuario)->get();
        $cantidadProductos = $carritoUsuario->count();
        $total = 0;
        foreach ($carritoUsuario as $uso){
            $total += $uso->total;
        }
        $correo = session('usuario')->correo;

        return view("miCarrito", [

         "carritoUsuario" =>$carritoUsuario,
         "cantidadProductos" => $cantidadProductos,
            "total" => $total,
            "correo"=>$correo

        ]);

    }

    public function borrarItem(Request $datos){

        $idProducto = $datos->idProducto;
        $idUsuario = session('usuario')->id_usuario;
        $findElement = CarritoUsuario::where('id_usuario',$idUsuario)->where('id_producto',$idProducto)->first();
        $deleteItem = CarritoUsuario::find($findElement->id_carrito_usuario);
        $deleteItem->delete();

        return response()->json($deleteItem);

    }

}
