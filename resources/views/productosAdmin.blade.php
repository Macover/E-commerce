@extends('layout_admin.mainAdmin')

@section('titulo')
    <title>VISTA ADMIN</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
    <h1 class="h3 mb-4 text-danger">Productos registrados</h1>
@endsection

@section('contenido')
    @php $productos = \App\Models\Producto::get();    @endphp
    <main>
        <div class="container">
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



                                <a class="btn btn-block btn-outline-danger" href="{{route('eliminar.productos.admin',$producto->id_producto)}}">Eliminar producto</a>

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

@endsection

