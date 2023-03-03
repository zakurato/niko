<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{asset("loginCss/articulosNuevasTallas2.Css")}}">

  <title>Articulos Nuevas Tallas</title>
</head>
<body>

  <div class="section" id="section-1">

  <div class="w3-row">
    <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
  </div>
  <br>
</div>

  <h1 style="font: 250% Arial; ">Articulos para actualizar o eliminar</h1>
  <br>

  <nav class="navbar">
    <ul>
      <li><a href="{{route('articulosNuevasTallas')}}">Inicio</a></li>
      <li>
        <a href="#">Categorías</a>
        <ul class="submenu">

          @foreach ($categoria as $item)
            <form action="{{route('articulosNuevasTallas')}}" method="GET">
                <li style="text-align: center"><input type="submit" value="{{$item->categoria}}" class="btnCategorias" name="txtBuscar"></li> 
            </form>
          @endforeach
        </ul>
      </li>
    </ul>
  </nav>
  <br>

  <a href="{{route("inventario")}}">
    <button class="btn2" type="button" >Volver</button>
  </a>

  <br><br>

  <p class="pSession">{{session("eliminar")}}</p>
  <p class="pSession">{{session("eliminarImagenCalzado")}}</p>

  <br><br><br>


<div>{{ $productos->appends(request()->input())->links('pagination::bootstrap-4') }}</div>
<div id="collage">
    @foreach ($productos as $item)
    <form action="{{route("vistaCrearTalla")}}" method="GET">
      @csrf
      <button type="submit" class="btnImg zoom">
        <img src="{{asset("imagesInventario/$item->imagen")}}">
        <p class="etiquetas2">{{$item->nombre}}</p>
        <input type="text" name="id" value="{{$item->id}}" hidden>
      </button>
    </form>
    @endforeach
  </div>
<div>{{ $productos->appends(request()->input())->links('pagination::bootstrap-4') }}</div>
  

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