<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset("ventasCss/ventas.Css")}}">
  <title>Vista Ventas Calzado</title>
</head>
<body>

  <script type="text/javascript">
    window.history.forward();
      function sinVueltaAtras(){ 
        window.history.forward(); 
      }
  </script>
  

  <br>

  <div class="section" id="section-1">
  <div class="w3-row">
    <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
  </div>
  </div>

  
  <br>
  <a href="{{route("index2")}}">
    <button class="btnVolver">Volver</button>
  </a>
  <br><br><br>

  <form method="POST" action="{{route("storeComprobante")}}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
        <input style="text-align: center" type="hidden" class=" pEtiquetas" name="imagenTenis" value="{{$productos->imagen}}" readonly><br>
        <input type="hidden" value="{{$productos->id}}" name="id">
        <div class="centrarEtiquetas">
          <div id="collage">
              <button type="button" class="btnImg">
                <img class="zoom" src="{{asset("imagesInventario/$productos->imagen")}}" style="max-width: 400px; height: 70%;">
                <label for="">{{$productos->nombre}}</label>
                <br>
                <div class="container2">
                  <div class="custom-select" style="width:300px;">
                    <select name="talla" required class="centrarEtiquetas">
                      <option value="" class="centrarEtiquetas">Seleccione la talla:</option>
                        @foreach ($tallas as $item)
                          @if ($item->imagen == $productos->imagen && $item->cantidad > 0)
                            <option class="centrarEtiquetas" value="{{$item->talla}}">
                              Talla: {{$item->talla}} EU Precio: ₡{{$item->precio}} 
                            </option>
                          @endif
                        @endforeach
                      </select>
                  </div>
                </div>
              </button>
          </div>
              <input type="hidden" value="{{$productos->categoria}}" name="categoria">
                @error('talla')
                <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>

          <div style="text-align: center">
            <a href="{{route("guiaTallas",[$productos->id, $productos->categoria])}}">Guía para tallas</a>
          </div>
      <br><br>
      <div class="form-group">
          <label for="cedula" class="pEtiquetas">Cédula:</label>
          <input id="_texto" type="cedula" class="form-control pEtiquetas" name="cedula" value="{{old("cedula")}}" required>
          @error('cedula')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      <div class="form-group">
        <label for="nombre" class="pEtiquetas">Nombre completo:</label>
        <input type="nombre" class="form-control pEtiquetas" name="nombre" value="{{old("nombre")}}" required>
        @error('nombre')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
          <label for="telefono" class="pEtiquetas">Teléfono:</label>
          <input id="_textoTelefono" type="phone" class="form-control pEtiquetas" name="telefono" value="{{old("telefono")}}" required>
          @error('telefono')
          <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="form-group">
          <label for="correo" class="pEtiquetas">Correo:</label>
          <input id="_textoCorreo" type="email" class="form-control pEtiquetas" name="correo" value="{{old("correo")}}" required>
          @error('correo')
          <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="form-group">
          <label for="direccion" class="pEtiquetas">Dirección exacta:</label>
          <textarea class="form-control pEtiquetas" rows="3" name="direccion" required>{{old("direccion")}}</textarea>
          @error('direccion')
          <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="form-group">
          <label class="form-label pEtiquetas" for="inputImage" required>Seleccione el comprobante:</label>
          <input 
              type="file" 
              name="image" 
              id="inputImage"
              class="form-control @error('image') is-invalid @enderror" required>

          @error('image')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <br>
      <button type="submit" class="btnEnviar" style="width: 100%; height: 50px; font: 120% Arial;">Enviar</button>
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