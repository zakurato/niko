<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("loginCss/inventario.Css?2.0")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Reporte ventas</title>
</head>
<body>

  <div class="section" id="section-1">

    <br>
    <div class="w3-row">
      <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
    </div>
    <br>

        <a href="{{route("inventario")}}">
            <button class="btn2" type="submit">Volver</button>
        </a>    

        <form action="{{route("actionReportesVentas")}}">
            @csrf
            <label for="fecha">Selecciona la fecha de inicio:</label>
            <input type="date" id="fecha" name="fechaInicio" value="{{ isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : date('Y-m-d') }}">
            <br><br>
            <label for="fecha2">Selecciona la fecha de fin:</label>
            <input type="date" id="fecha2" name="fechaFin" value="{{ isset($_GET['fechaFin']) ? $_GET['fechaFin'] : date('Y-m-d') }}">
            <br><br>
            <button class="btnBuscar" type="submit">Buscar</button>
        </form>
        

        <br><br><br><br>

        <table style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #f8f8f8;">
              <th style="padding: 10px; border: 1px solid #ddd;">Datos</th>
              <th style="padding: 10px; border: 1px solid #ddd;">Imagenes</th>
              <th style="padding: 10px; border: 1px solid #ddd;">Total = {{$total}}</th>
            </tr>
            @foreach ($compras as $item)
            <tr>
              <td style="padding: 10px; border: 1px solid #ddd;">Nombre: {{ $item->nombre }}</td>
              <td style="padding: 10px; border: 1px solid #ddd;">
                <img style="max-width: 100px; max-height: 100px;" src="{{ asset('imagesInventario/'.$item->imagen) }}">
              </td>
              <td style="padding: 10px; border: 1px solid #ddd;">Precio: {{ $item->precio }}</td>
            </tr>
            <tr>
              <td style="padding: 10px; border: 1px solid #ddd;">Cedula: {{ $item->cedula }}</td>
              <td style="padding: 10px; border: 1px solid #ddd;">
                <img style="max-width: 100px; max-height: 100px;" src="{{ asset('imagesComprobantes/'.$item->imagenComprobante) }}">
              </td>
              <td style="padding: 10px; border: 1px solid #ddd;"></td>
            </tr>
            <tr>
              <td style="padding: 10px; border: 1px solid #ddd;">Telefono: {{ $item->telefono }}</td>
              <td style="padding: 10px; border: 1px solid #ddd;"></td>
              <td style="padding: 10px; border: 1px solid #ddd;"></td>
            </tr>
            <tr>
              <td style="padding: 10px; border: 1px solid #ddd;">Talla: {{ $item->talla }}</td>
              <td style="padding: 10px; border: 1px solid #ddd;"></td>
              <td style="padding: 10px; border: 1px solid #ddd;"></td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Categoria: {{ $item->categoria }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;"></td>
                <td style="padding: 10px; border: 1px solid #ddd;"></td>
              </tr>
              <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Fecha de venta: {{ $item->created_at }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;"></td>
                <td style="padding: 10px; border: 1px solid #ddd;"></td>
              </tr>

              <tr style="background-color: black;">
                <th style="padding: 10px; border: 1px solid #ddd;"></th>
                <th style="padding: 10px; border: 1px solid #ddd;"></th>
                <th style="padding: 10px; border: 1px solid #ddd;"></th>
              </tr>
            @endforeach
          </table>
          
          
          








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


</body>


</html>