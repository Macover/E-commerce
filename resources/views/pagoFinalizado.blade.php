@extends('layout.main')

@section('titulo')
    <title>ISASPORTS</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')

@endsection

@section('contenido')




    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">¡Tu pedido ha sido realizado con exito!</h1>
            <h3 class="h4 text-gray-900 mb-4">Puedes ver tus pedidos aqui</h3>
        </div>
        <a href="{{route('vista.mis.pedidos')}}" class="btn btn-outline-info btn-user btn-block">
            Ir a mis pedidos
        </a>

@endsection

@section('js')

@endsection

