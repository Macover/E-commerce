@extends('layout.main')

@section('titulo')
    <title>ISASPORTS</title>
@endsection

@section('css')

@endsection

@section('numeroCarrito')



        <form method="get" action="{{route('mi.carrito')}}">
            <span id="cantidadCompras" class="badge badge-danger badge-counter">0</span>
            <button id="subir" class="fas fa-shopping-cart"></button>
        </form>



@endsection

@section('titulo-pagina')

@endsection

@section('contenido')
    @php $productos = \App\Models\Producto::get();    @endphp
    <main>
        <div class="container">

            <h1 class="h3 mb-4 text-gray-800">Productos Usuario</h1>
            <!--Section: Products v.3-->
            <section class="text-center mb-4">
                <!--Grid row-->
                <div class="row wow fadeIn">

                @foreach($productos as $producto)
                    <!--Grid column-->
                        <div class="col-lg-3 col-md-6 mb-4">

                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay">
                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{$producto->ruta_imagen1}}" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{$producto->ruta_imagen2}}" class="d-block w-100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <a>
                                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body text-center">
                                    <!--Category & Title-->
                                    <a href="" class="grey-text">
                                        <h5>{{$producto->nombre_producto}}</h5>
                                    </a>
                                    <h5>
                                        <strong>
                                            <span class="dark-grey-text">{{$producto->descripcion}}</span>
                                            </a>
                                        </strong>
                                    </h5>

                                    <h4 class="font-weight-bold blue-text">
                                        <strong>${{$producto->precio}}</strong>
                                    </h4>
                                    <input type="hidden" id="count" value="{{$producto->count()}}">
                                    <button id="idCarrito{{$loop->index + 1}}"
                                            class="btn btn-block btn-outline-success">Agregar al carrito
                                    </button>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->
                    @endforeach
                </div>
                <!--Grid row-->
            </section>
            <!--Section: Products v.3-->

        </div>
    </main>

@endsection

@section('js')

    <script>


        let datosArray = [];
        $(document).ready(function () {


            let numeroCarrito = 0;

            @foreach($productos as $uso)
            $("#idCarrito{{$loop->index + 1}}").click(function (e) {
                e.preventDefault();
                numeroCarrito++;
                console.log("click al boton" +{{$loop->index + 1}});
                console.log("el id del producto es: " +{{$uso->id_producto}});
                $("#cantidadCompras").html(numeroCarrito);
                datosArray[numeroCarrito - 1] = {{$uso->id_producto}}
                console.log(datosArray);
            });
            @endforeach
            peticionAjax();
            function peticionAjax(){
                //enviar al servidor
                $("#subir").click(function(e) {

                    if (numeroCarrito == 0){
                        e.preventDefault();
                        alert("no has seleccionado productos aún")
                    }
                    else{

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{route('carrito.pedidos')}}",
                            data: {'arrayAjax': JSON.stringify(datosArray)},//capturo array
                            success: function(data){
                                console.log(data);
                            }
                        });

                    }

                });
            }

        });

    </script>

@endsection

