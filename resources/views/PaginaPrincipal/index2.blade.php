<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("indexCss/index2.css")}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
    integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">


    <title>Pagina Principal2</title>
</head>
<body>
    <div class="section" id="section-1">
        <div class="w3-row">
            <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
        </div>
    </div>
    <br>
    <div class="section" id="section-2">
      <nav class="navbar">
        <ul>
          <li><a href="{{route('index2')}}">Inicio</a></li>
          <li><a href="{{route('vistaLogin')}}">Administración</a></li>
          <li><a href="#" onclick="mostrarSubcategorias()">Categorías</a>
            <ul class="submenu" id="subcategorias">
              @foreach ($categoria as $item)
                <form action="{{route('index2')}}" method="GET">
                  @csrf
                  <li style="text-align: center">
                    <input type="submit" value="{{$item->categoria}}" class="btnCategorias" name="txtBuscarCategoria">
                  </li> 
                </form>
              @endforeach
            </ul>
          </li>
        </ul>
        <form class="search-form">
          <input type="text" name="txtBuscar" placeholder="Buscar por nombre..." value="{{$textoABuscar}}" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
          <button type="submit">Buscar</button>
        </form>
      </nav>
      
        <br>

        <br>
        <div>{{ $productos->appends(request()->input())->links('pagination::bootstrap-4') }}</div>
        <div id="collage">
            @foreach ($productos as $item)
            <button type="button" class="btnImg zoom" onclick="location.href = '{{route('mostrarProducto',$item->id)}}'">
              <img src="{{asset("imagesInventario/$item->imagen")}}">
              <p class="etiquetas2">{{$item->nombre}}</p>
              @if (session("cantidad") == $item->imagen)
                <p class="pSession">No hay existencia de este artículo</p>
              @endif
            </button>
            @endforeach
          </div>
        <div>{{ $productos->appends(request()->input())->links('pagination::bootstrap-4') }}</div>

        </div>

      <br>
      <br><br><br><br><br><br>
      <div class="section" id="section-3">
        <footer style="background-color: black; color: white; padding: 80px;">
            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
              <a href="https://www.instagram.com/coquetta.boutique/" target="_blank" style="margin-right: 10px;">
                <i class="fab fa-instagram" style="font-size: 24px; color: white"></i>
              </a>
              <a href="https://api.whatsapp.com/send?phone=50683433925&text=Hola!%20Quiero%20obtener%20mas%20información%20sobre%20un%20producto" target="_blank" style="margin-right: 10px;">
                <i class="fab fa-whatsapp" style="font-size: 24px; color: white"></i>
              </a>
              <a href="tel:+50683433925" style="margin-right: 10px;">
                <i class="fas fa-mobile-alt" style="font-size: 24px; color: white"></i>
              </a>
            </div>
            <p style="text-align: center;">&copy; Coquetta Boutique. Todos los derechos reservados. <br>
            <a href="{{route("politicas")}}" style="color: white">Política de privacidad</a></p>
          </footer>
      </div>
    
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


<script>
function mostrarSubcategorias() {
  var subcategorias = document.getElementById("subcategorias");
  if (subcategorias.style.display == "none") {
    subcategorias.style.display = "block";
  } else {
    subcategorias.style.display = "none";
  }
}
  </script>

</html>