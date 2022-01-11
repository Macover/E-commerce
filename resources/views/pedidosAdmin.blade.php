@extends('layout_admin.mainAdmin')

@section('titulo')
    <title>VISTA ADMIN</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
    <h1 class="h3 mb-4 text-danger">Pedidos realizados</h1>
@endsection

@section('contenido')
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                @php $pedidosRealizados = \App\Models\pedidosUsuario::get();    @endphp
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Usuario</th>
                            <th>ID Producto</th>
                            <th>Nombre del producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>ID metodo de pago</th>
                            <th>Direccion</th>
                            <th>Fecha de compra</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>ID Usuario</th>
                            <th>ID Producto</th>
                            <th>Nombre del producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>ID metodo de pago</th>
                            <th>Direccion</th>
                            <th>Fecha de compra</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($pedidosRealizados as $uso)
                            <tr>
                                <td>{{$loop->index}}</td>
                                <td>{{$uso->id_usuario}}</td>
                                <td>{{$uso->id_producto}}</td>
                                <td>{{$uso->nombre_producto}}</td>
                                <td>{{$uso->precio}}</td>
                                <td>{{$uso->cantidad}}</td>
                                <td>{{$uso->id_metodo_pago}}</td>
                                <td>{{$uso->direccion}}</td>
                                <td>{{$uso->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

