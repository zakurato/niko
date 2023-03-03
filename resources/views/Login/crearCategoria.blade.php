<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("loginCss/crearCategoria.Css?1.0")}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>Crear Categoria</title>
</head>
<body>

    <div class="section" id="section-1">
    <br>
    <div class="w3-row">
      <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
    </div>
    <br>
    </div>

    <form action="{{route("storeCategoria")}}" method="POST">
        @csrf
        <label class="etiquetaLabel" for="Nombre categoría">Nombre de la categoría</label>
        <br><br>
        <input class="form-control input" type="text" name="nombreCategoria" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
        <br><br>
        <p class="pSession">{{session("mensaje")}}</p>
        <p class="pSession">{{session("eliminarCategoria")}}</p>
        <br>
        <button class="btnCrearCategoria" type="submit">Crear categoría</button>
    </form>
    <a href="{{route("inventario")}}">
        <input class="btnVolver" type="button" value="Volver">
    </a>
    <br><br><br><br>

    
     <table border="1">
        <caption style="text-align: center">Categorías</caption>
        @foreach ($categorias as $item)
          <tr>
            <td>{{$item->categoria}}</td>
            <td>
                <form action="{{route("eliminarCategoria")}}" method="POST">
                    @method("delete")
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button class="btnEliminar" type="submit">Eliminar categoría</button>
                </form>
            </td>
          </tr>
        @endforeach
      </table>


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