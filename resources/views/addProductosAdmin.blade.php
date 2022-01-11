@extends('layout_admin.mainAdmin')

@section('titulo')
    <title>VISTA ADMIN</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
    <h1 class="h3 mb-4 text-danger">Añadir Productos</h1>
@endsection

@section('contenido')

    @if(isset($estatus))
        @if($estatus == "success")
            <label class="text-success">{{$mensaje}}</label>
        @elseif($estatus == "error")
            <label class="text-warning">{{$mensaje}}</label>
        @endif
    @endif

    <form method="post" action="{{route('registrar.productos.admin')}}" enctype="multipart/form-data">
        @csrf
        {{csrf_field()}}
        <div class="form-group">
            <label>Nombre del producto</label>
            <input type="text" class="form-control" name="nombreProducto">
            <small id="emailHelp" class="form-text text-muted">Intente no utilizar caracteres UNICODE</small>
        </div>

        <label>Precio</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="text" class="form-control" name="precio"><br>
            @error('precio')
            <label class="text-warning">{{$message}}</label>
            @enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="3" name="descripcion"></textarea>
        </div>
       <!-- input images here -->

        <div class="form-group">
            <label>Ingrese la primera imagen</label>
            <input type="file" class="form-control-file" name="img1" accept="image/*">
            @error('img1')
                <label class="text-warning">{{$message}}</label>
            @enderror
        </div>
        <div class="form-group">
            <label>Ingrese la segunda imagen</label>
            <input type="file" class="form-control-file" name="img2" accept="image/*">
            @error('img2')
            <label class="text-warning">{{$message}}</label>
            @enderror
        </div>
        <button type="submit" class="btn btn-info">Registrar producto</button>
    </form>

@endsection

@section('js')

@endsection

