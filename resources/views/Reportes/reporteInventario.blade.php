<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("indexCss/index2.css")}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
    integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">


    <title>Reporte inventario</title>
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
        <li><a href="{{route("inventario")}}" >Volver</a>
          <li><a href="#" onclick="mostrarSubcategorias()">Categorías</a>
            <ul class="submenu" id="subcategorias">
                <form action="{{route('reporteInventario')}}" method="GET">
                    <li style="text-align: center">
                        <input type="submit" value="TODAS" class="btnCategorias" name="txtBuscarCategoria">
                    </li> 
                </form>

              @foreach ($categoria as $item)
                <form action="{{route('reporteInventario')}}" method="GET">
                  @csrf
                  <li style="text-align: center">
                    <input type="submit" value="{{$item->categoria}}" class="btnCategorias" name="txtBuscarCategoria">
                  </li> 
                </form>
              @endforeach
            </ul>
          </li>
        </ul>
      </nav>



      
      <?php
      // Inicializar el array asociativo de categorías
      $cantidadesPorCategoria = [];
      
      // Recorrer todos los productos
      foreach ($productos as $producto) {
          // Obtener la categoría del producto
          $categoria = $producto->categoria;
      
          // Si la categoría aún no está en el array asociativo, inicializarla en cero
          if (!isset($cantidadesPorCategoria[$categoria])) {
              $cantidadesPorCategoria[$categoria] = 0;
          }
      
          // Recorrer todas las tallas
          foreach ($tallas as $talla) {
              // Si la imagen de la talla coincide con la imagen del producto y la cantidad es un número válido
              if ($talla->imagen == $producto->imagen && is_numeric($talla->cantidad)) {
                  // Agregar la cantidad de pares al total de la categoría del producto
                  $cantidadesPorCategoria[$categoria] += intval($talla->cantidad);
              }
          }
      }
      
      // Recorrer el array asociativo de categorías y cantidades
      foreach ($cantidadesPorCategoria as $categoria => $cantidad) {
          // Imprimir el nombre de la categoría y la cantidad de pares existentes
          echo '<div style="text-align: left !important;">';
          echo  $categoria .' Existencia de pares: ' . $cantidad ;
          echo '</div>';
      }
       ?>
      
        <br>
        <div id="collage" style="display: flex; flex-wrap: wrap;">
            @foreach ($productos as $item)
              <div style="width: 50%; display: flex; flex-direction: column; align-items: center;">
                <img style="width: 300px; height: 300px;" src="{{ asset("imagesInventario/$item->imagen") }}">
                <p class="etiquetas2">{{ $item->nombre }}</p>
                @foreach ($tallas as $item2)
                    @if ($item2->imagen == $item->imagen)
                        @if ($item2->cantidad == 0)
                          <div>
                            <p class="etiquetas2" style="display: inline; color: red">Talla: {{ $item2->talla }}</p>
                            <p class="etiquetas2" style="display: inline; color: red">Existencia de pares: {{ $item2->cantidad }}</p>
                          </div>  
                        @else
                          <div>
                            <p class="etiquetas2" style="display: inline;">Talla: {{ $item2->talla }}</p>
                            <p class="etiquetas2" style="display: inline;">Existencia de pares: {{ $item2->cantidad }}</p>
                          </div> 
                        @endif                 
                    @endif
                @endforeach
              </div>
            @endforeach
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