<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset("ventasCss/factura.Css")}}">

    <title>Documentos</title>
</head>
<body>

    <div class="section" id="section-1">
      <div class="w3-row">
          <div class="wrap"><h1>COQUETTA BOUTIQUE</h1></div>
      </div>
      <br>

        <div class="form-group">
            <label for="cedula" class="pEtiquetas" required>Cédula:</label>
            <input type="cedula" class="form-control pEtiquetas" value="{{$compras->cedula}}" readonly>
          </div>
        <div class="form-group">
          <label for="nombre" class="pEtiquetas" required>Nombre completo:</label>
          <input type="nombre" class="form-control pEtiquetas" value="{{$compras->nobmre}}" readonly>

        </div>
        <div class="form-group">
            <label for="telefono" class="pEtiquetas" required>Teléfono:</label>
            <input type="phone" class="form-control pEtiquetas" value="{{$compras->telefono}}" readonly>
        </div>
        <div class="form-group">
            <label for="correo" class="pEtiquetas" required>Correo:</label>
            <input type="email" class="form-control pEtiquetas" value="{{$compras->correo}}" readonly>
        </div>
        <div class="form-group">
            <label for="direccion" class="pEtiquetas" required>Dirección exacta:</label>
            <textarea class="form-control pEtiquetas" rows="3" readonly>{{$compras->direccion}}</textarea>
        </div>
        <div class="form-group">
            <label for="direccion" class="pEtiquetas" required>Talla:</label>
            <textarea class="form-control pEtiquetas" rows="3" readonly>{{$compras->talla}}</textarea>
        </div>
        <div class="form-group">
            <label for="direccion" class="pEtiquetas" required>Precio:</label>
            <textarea class="form-control pEtiquetas" rows="3" readonly>{{$compras->precio}}</textarea>
        </div>
        <div class="form-group">
            <label for="direccion" class="pEtiquetas" required>Categoria:</label>
            <textarea class="form-control pEtiquetas" rows="3" readonly>{{$compras->categoria}}</textarea>
        </div>
        
    
        <div id="collage">
          <button type="button" class="btnImg zoom">
          <img class="zoom" style="width: 400px; height: 70%;" src="{{asset("imagesInventario/$compras->imagen")}}">
        </button>
        </div>
        <div id="collage">
          <button type="button" class="btnImg zoom">
            <img class="zoom" style="width: 400px; height: 70%;" src="{{asset("imagesComprobantes/$compras->imagenComprobante")}}">
          </button>
        </div>
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
</html>