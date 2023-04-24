<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{asset("loginCss/inventario.Css?1.0")}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    
    <title>Vista Crear Talla</title>
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
    <p class="pSession">{{session("noEliminarImagenCalzado")}}</p>


    <div class="container">
        <form style="display: inline;" action="{{route("eliminarArticulo2")}}" method="POST">
            @method("delete")
            @csrf
            <input type="text" name="imagen" value="{{$producto->imagen}}" hidden>
            <input type="text" name="id" value="{{$producto->id}}" hidden>
            <button class="btnEliminar2" type="submit">Eliminar imagen</button>
            <br>
        </form>
    </div>

    <div class="container">
        <img src="{{asset("imagesInventario/$producto->imagen")}}" style="max-width: 400px; height: 70%;">
    </div>

    <div class="container2">
      <div style="text-align: center; width: 80%; margin: 0 auto;">
        <label for="">{{$producto->nombre}}</label>
      </div>
      <br>
        @foreach ($tallas as $item)
            @if ($item->imagen == $producto->imagen)
                <label class="pEtiquetasVistaCrearTalla">Tallas ya existentes: {{$item->talla}} Cantidad en inventario: {{$item->cantidad}} Precio: ₡{{$item->precio}}</label>
                <form style="display: inline;" action="{{route("eliminarArticulo")}}" method="POST">
                    @method("delete")
                    @csrf
                    <input type="text" name="imagen" value="{{$item->imagen}}" hidden>
                    <input type="text" name="talla" value="{{$item->talla}}" hidden>
                    <input type="text" name="id" value="{{$producto->id}}" hidden>
                    <button class="btnEliminar" type="submit">Eliminar</button>
                    <br>
                </form>
            @endif
        @endforeach
    </div>

    <form action="{{route("storeVistaCrearTalla")}}" method="POST">
        @csrf   
            <input type="text" name="imagenInventario" value="{{$producto->imagen}}" hidden>
            <input type="text" name="id" value="{{$producto->id}}" hidden>


        <br><br>
        <div class="form-group">
            <label for="nombre" class="pEtiquetas">Nombre del articulo:</label>
            <input type="text" name="nombreOld" value="{{$producto->nombre}}" hidden>
            <input type="text" class="form-control pEtiquetas" name="nombre" value="{{$producto->nombre}}" required onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="categoria" class="pEtiquetas">Categoria:</label>
            <input type="text" name="categoriaOld" value="{{$producto->categoria}}" hidden>
            <input type="text" class="form-control pEtiquetas" name="categoria" value="{{$producto->categoria}}" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required >
            @error('categoria')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="talla" class="pEtiquetas">Talla:</label>
            <input type="number" inputmode="numeric" pattern="[0-9]*" class="form-control pEtiquetas" name="talla" value="{{old("talla")}}" required>
            @error('talla')
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