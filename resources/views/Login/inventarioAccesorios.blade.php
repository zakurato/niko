<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("loginCss/inventario.Css?1.0")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>inventarioAccesorios</title>
</head>
<body>

  <div class="section" id="section-1">

    <br>
    <div class="w3-row">
      <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
    </div>
    <br>

    <h1 style="font: 250% Arial; font-weight: 1000">Accesorios</h1>
    <br>
    <p class="pSession">{{session("exito")}}</p>
    <p class="pSession">{{session("categoria")}}</p>
    <p class="pSession">{{session("existe")}}</p>
    <br><br><br>


    <label class="pEtiquetas" required>Seleccione:</label><br>
    <div id="mainselection">
      <select name="" id="selectOption" onchange="GetSelectedTextValue(this)">
        <option value="">-</option>
          <option value="1">Calzado</option>
          <option value="2">Accesorios</option>
      </select>
    </div>
    <br><br><br><br>


    <form action="{{route("logout")}}" method="POST">
        @csrf
        <button class="btn2" type="submit">Cerrar sesión</button>
    </form>

    <a href="{{route("vistaCrearCategoriaAccesorios")}}" >
      <input type="button" value="Crear o eliminar categoría" class="btnCrearCategoria">
    </a>
    
    <br><br><br>

    <form method="POST" action="{{route("storeAccesorios")}}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group" >
          <label class="form-label pEtiquetas" for="inputImage" required>Seleccione la imagen del articulo:</label>
          <input 
              type="file" 
              name="image" 
              id="inputImage"
              class="form-control" 
              required>

          @error('image')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
        <div class="form-group">
            <label for="nombre" class="pEtiquetas" required>Nombre del articulo:</label>
            <input type="nombre" class="form-control pEtiquetas" name="nombre" value="{{old("nombre")}}" required onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;>
            @error('nombre')
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

        <label for="categoria" class="pEtiquetas" required>Categoria:</label>
        <div id="mainselection">
          <select name="categoria" id="selectOption">
            <option value="">-</option>
            @foreach ($categoria as $item)
              <option value="{{$item->categoria}}">{{$item->categoria}}</option>
            @endforeach
          </select>
        </div>

        @error('categoria')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <br><br><br>
     
        <br>
        <button type="submit" class="btnGuardarArticulo" style="width: 100%; height: 50px; font: 120% Arial;">Guardar articulo</button>
      </form>

      <div class="linea"></div>

      <br><br><br>

        <a href="{{route("articulosNuevasTallas")}}">
          <button class="btnArticulosNuevasTallas">Actualizar y eliminar articulos</button>
        </a>
        <br><br><br>
        <a href="{{route("reporteVentas")}}">
          <button class="btnArticulosNuevasTallas">Reporte de ventas</button>
        </a>
      </div>

</body>

<script>
  /*scrip del select de accesorios y tenis*/

  function GetSelectedTextValue(selectOption) {
  var selVal = selectOption.value;

  if(selVal == 1){
    window.location.href = "http://54.237.32.55/inventario";
  }else{
    window.location.href = "http://54.237.32.55/inventarioAccesorios";
  }
  
}
</script>


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