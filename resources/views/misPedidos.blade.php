@extends('layout.main')

@section('titulo')
    <title>ISASPORTS</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')

@endsection

@section('contenido')
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre del producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Direccion</th>
                                <th>ID metodo de pago</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nombre del producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Direccion</th>
                                <th>ID metodo de pago</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($pedidosUsuario as $uso)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$uso->nombre_producto}}</td>
                                    <td>{{$uso->precio}}</td>
                                    <td>{{$uso->cantidad}}</td>
                                    <td>{{$uso->direccion}}</td>
                                    <td>{{$uso->id_metodo_pago}}</td>
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

    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>

    </script>

@endsection

