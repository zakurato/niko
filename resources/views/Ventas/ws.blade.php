<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset("ventasCss/ws.Css")}}">

    <title>WA Assesorios</title>
</head> 
<body>
    <div class="section" id="section-1">
    <br>
    <div class="w3-row">
      <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
    </div>
    <br>
    
        <a href="https://api.whatsapp.com/send?phone=50683433925&text=DATOS DE COMPRA!!!%0aNombre:%20{{$store->nombre}}%0aCedula:%20{{$store->cedula}}%0aTeléfono:%20{{$store->telefono}}%0aLink con los datos:%20http://54.237.32.55/mostrar/factura/tenis/{{$store->id}}">
            <button type="button" class="btn btn-primary" style="width: 100%; height: 100px;">Enviar compra por whatApps</button>
        </a>
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