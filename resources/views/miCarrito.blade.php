@extends('layout.main')

@section('titulo')
    <title>ISASPORTS</title>
@endsection

@section('css')

@endsection

@section('titulo-pagina')
    <h1 class="h3 mb-4 text-gray-800">Checkout</h1>
@endsection

@section('contenido')

    <div class="row">

        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tu carrito</span>
                <span class="badge badge-secondary badge-pill">{{$cantidadProductos}}</span>
            </h4>

            <ul class="list-group mb-3">
                @foreach($carritoUsuario as $uso)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Producto: {{$uso->nombre_producto}}</h6>
                        <small class="text-muted">Cantidad: {{$uso->cantidad}}</small>
                    </div>
                    <span class="text-muted">${{$uso->total}}</span>
                    <button class="btn btn-outline-danger btn-lg" id="borrar{{$loop->index + 1}}">Borrar item</button>
                </li>
                @endforeach
                    <span>Total (MXN)</span>
                    <strong>${{$total}}</strong>
                </li>
            </ul>

        </div>


        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Ingrese su informacion por favor.</h4>
            <form class="needs-validation" method="post" action="{{route('finalizar.pedido')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nombres</label>
                        <input name="nombres" type="text" class="form-control" required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Apellidos</label>
                        <input name="apellidos" type="text" class="form-control" id="lastName" required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="username" placeholder="{{$correo}}" disabled>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Dirección</label>
                    <input name="direccion" type="text" class="form-control" required="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <hr class="mb-4">


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Nombre titular</label>
                        <input name="titular" type="text" class="form-control" id="cc-name"  required="">
                        @error('titular')
                        <label class="text-warning">{{$message}}</label>
                        @enderror
                        <small class="text-muted">Nombre completo como se muestra en su tarjeta</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Numero de tarjeta</label>
                        <input name="noTarjeta" type="text" class="form-control" id="cc-number" placeholder="" required="">
                        @error('noTarjeta')
                        <label class="text-warning">{{$message}}</label>
                        @enderror
                        <div class="invalid-feedback">
                            El numero de tarjeta se requiere
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expira en</label><br>
                        <input name="fecha" type="date" name="trip-start"
                               value="2021-04-12"
                               min="2021-04-12" max="2030-12-31">
                        <div class="invalid-feedback">
                            La fecha de expiración se requiere
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input name="cvv" type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                        @error('cvv')
                        <label class="text-warning">{{$message}}</label>
                        @enderror
                        <div class="invalid-feedback">
                            El CVV se requiere revise al reverso de su tarjeta.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-outline-info btn-lg btn-block" type="submit">Realizar la compra</button>
            </form>
        </div>
    </div>

@endsection

@section('js')

    <script>
        let idProducto = 0;
        $(document).ready(function () {

            @foreach($carritoUsuario as $uso)
            $("#borrar{{$loop->index + 1}}").click(function (e) {
                e.preventDefault();
                console.log("click al boton" +{{$loop->index + 1}});
                idProducto = {{$uso->id_producto}}
                console.log(idProducto);
                $("#borrar{{$loop->index + 1}}").html("borrado");
                $(this).removeClass();
                $(this).addClass('btn btn-secondary btn-lg');
                $(this).prop('disabled', false);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{route('borrar.item')}}",
                    data: {'idProducto': idProducto},
                    success: function(data){
                        console.log(data);
                    }
                });
            });
            @endforeach

        });


    </script>

@endsection

