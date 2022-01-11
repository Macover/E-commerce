<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function productosRegistrados()
    {
        return view("productosAdmin");
    }

    public function addProductos()
    {
        return view("addProductosAdmin");
    }

    public function registrarProducto(Request $datos)
    {

        if (!$datos->nombreProducto || !$datos->precio || !$datos->descripcion) {

            return view("addProductosAdmin", ["estatus" => "error", "mensaje" => "¡Falta información!"]);

        } else {

            //imagen 1
            $datos->validate([
                'img1' => 'required|image|max:4000'
            ]);
            $datos->validate([
                'img2' => 'required|image|max:4000'
            ]);
            $datos->validate([
                'precio' => 'numeric|min:1|max:10000'
            ]);

            $img1 = $datos->file('img1')->store('public/productos');
            $img2 = $datos->file('img2')->store('public/productos');
            $url1 = Storage::url($img1);
            $url2 = Storage::url($img2);


            $producto = new Producto();
            $producto->nombre_producto = $datos->nombreProducto;
            $producto->precio = $datos->precio;
            $producto->descripcion = $datos->descripcion;
            $producto->ruta_imagen1 = $url1;
            $producto->ruta_imagen2 = $url2;
            $producto->save();

            return view("addProductosAdmin",
                ["estatus" => "success", "mensaje" => "¡Producto agregado exitosamente!"]);


        }
    }

    public function eliminarProducto($idProducto){

        $query = Producto::find($idProducto);
        $query->delete();
        return view("productosAdmin");

    }

    public function pedidosRealizados(){
        return view("pedidosAdmin");
    }


    /*
     *
     *          $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{route('graficas.re')}}",
                data: 2,
                success: function (data) {
                    let numeroHombres = 0;
                    let numeroMujeres = 0;
                    let puntajesHombre = 0;
                    let puntajesMujer = 0;
                    for (var i=0; i<data.length; i++){
                        if (data[i]["genero"] == "masculino"){
                            numeroHombres++;
                            puntajesHombre += data[i]["puntaje"];
                            edades[i] = data[i]["edad"];
                            ids[i] = data[i]["id_usuario"];
                        }
                        if (data[i]["genero"] == "femenino"){
                            numeroMujeres++;
                            puntajesMujer += data[i]["puntaje"];
                            edades[i] = data[i]["edad"];
                            ids[i] = data[i]["id_usuario"];
                        }
                    }
                    let promedioHombre = puntajesHombre / 5;
                    let promedioMujer = puntajesMujer / 5;

                    numeroGenero[0]=numeroMujeres;
                    numeroGenero[1]=numeroHombres;

                    promediosPuntaje[0]=promedioMujer;
                    promediosPuntaje[1]=promedioHombre;

                    console.log(edades);
                    graficaEdades();

                }

            });
     */

}

