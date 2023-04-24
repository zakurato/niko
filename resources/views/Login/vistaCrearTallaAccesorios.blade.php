<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{asset("loginCss/inventario.Css?2.0")}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Vista Crear Talla Accesorios</title>
</head>
<body>

    <div class="section" id="section-1">
    <br>
    <div class="w3-row">
      <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
    </div>
    <br>
    </div>

    <a href="{{route("articulosNuevasTallas")}}">
      <button class="btn2" type="button" >Volver</button>
    </a>


    <br><br><br>

    <p class="pSession">{{session("eliminar")}}</p>
    <p class="pSession">{{session("exito")}}</p>
    <p class="pSession">{{session("actualizarCantidad")}}</p>

    <div class="container">
      <img src="{{asset("imagesInventario/$producto->imagen")}}" style="max-width: 400px; height: 70%;">
    </div>

    <div class="container2">
      <div class="container2">
        <div style="text-align: center; width: 80%; margin: 0 auto;">
          <label for="">{{$producto->nombre}}</label>
        </div>
        <br>
                <label class="pEtiquetasVistaCrearTalla">Cantidad en inventario: {{$tallas->cantidad}} Precio: ₡{{$tallas->precio}}</label>
                <form style="display: inline;" action="{{route("eliminarArticuloAccesorios")}}" method="POST">
                    @method("delete")
                    @csrf
                    <input type="text" name="imagen" value="{{$tallas->imagen}}" hidden>
                    <input type="text" name="id" value="{{$producto->id}}" hidden>
                    <button class="btnEliminar" type="submit">Eliminar</button>
                    <br>
                </form>

    </div>

    <form action="{{route("storeVistaCrearTallaAccesorios")}}" method="POST">
        @csrf   
            <input type="text" name="imagenInventario" value="{{$producto->imagen}}" hidden>
            <input type="text" name="id" value="{{$producto->id}}" hidden>


        <br><br>

        <div class="form-group">
            <label for="nombre" class="pEtiquetas" >Nombre:</label>
            <input required class="form-control pEtiquetas" name="nombre" value="{{$producto->nombre}}">
            <input type="hidden" required class="form-control pEtiquetas" name="oldNombre" value="{{$producto->nombre}}">
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria" class="pEtiquetas" >Categoria:</label>
            <input required class="form-control pEtiquetas" name="categoria" value="{{$producto->categoria}}">
            <input type="hidden" required class="form-control pEtiquetas" name="oldCategoria" value="{{$producto->categoria}}">
            @error('categoria')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad" class="pEtiquetas" >Cantidad:</label>
            <input required type="number" inputmode="numeric" pattern="[0-9]*" class="form-control pEtiquetas" name="cantidad" value="{{old("cantidad")}}">
            @error('cantidad')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="precio" class="pEtiquetas" >Precio:</label>
            <input required type="number" inputmode="numeric" pattern="[0-9]*" class="form-control pEtiquetas" name="precio" value="{{old("precio")}}">
            @error('precio')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btnGuardarArticulo" style="width: 100%; height: 50px; font: 120% Arial;">Guardar articulo</button>
    </form>

</body>


<script>
    /*script para las secciones en movimiento*/
    const sections = document.querySelectorAll('.section');
    const options = {
      threshold: 0.2
    };
    
    const observer = new IntersectionObserver(function(entries, observer) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        } else {
          entry.target.classList.remove('visible');
        }
      });
    }, options);
    
    sections.forEach(section => {
      observer.observe(section);
    });
  </script>
</html>