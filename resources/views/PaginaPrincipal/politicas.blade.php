<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("indexCss/index2.css")}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
    integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">


    <title>Politicas</title>
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
        </ul>
      </nav>
      <br><br>
      <p>
        <p style="text-align: center">Política de privacidad de Coquetta Boutique.</p> 
         <br><br>

En Coquetta Boutique, nos tomamos muy en serio la privacidad de nuestros clientes y usuarios. Por lo tanto, hemos creado esta política de privacidad para explicar cómo recopilamos, usamos, divulgamos y protegemos la información personal de nuestros clientes.
<br><br>
Recopilación de información personal
<br>
Recopilamos información personal cuando los clientes realizan una compra en nuestra tienda en línea. Esta información puede incluir la cédula, el nombre completo, el teléfono, el correo electronico y la direccion exacta del domicilio.
<br><br>
Uso de la información personal
<br>
La información personal recopilada se utiliza para procesar la compra del cliente y proporcionar los productos o servicios solicitados. También podemos utilizar la información personal para comunicarnos con el cliente sobre el estado del pedido, enviar información de marketing y promociones, o para cumplir con nuestras obligaciones legales.
<br><br>
Divulgación de información personal
<br>
No compartimos la información personal de nuestros clientes con terceros, excepto cuando sea necesario para procesar la compra o cumplir con obligaciones legales. Por ejemplo, podemos compartir la información personal con nuestros proveedores de servicios de pago para procesar el pago del cliente.
<br><br>
Protección de la información personal
<br>
Tomamos medidas de seguridad razonables para proteger la información personal de nuestros clientes contra el acceso no autorizado, la divulgación y el uso indebido. Utilizamos tecnologías de encriptación y protección de datos para garantizar que la información personal se transmita de manera segura y almacenada de manera segura.
<br><br>
Cambios a esta política de privacidad
<br>
Nos reservamos el derecho de actualizar o modificar esta política de privacidad en cualquier momento. Cualquier cambio significativo en esta política de privacidad se publicará en nuestro sitio web y se comunicará a los clientes por correo electrónico o por otros medios.
<br><br>
Contacto
<br>
Si tiene alguna pregunta o inquietud sobre esta política de privacidad o sobre cómo manejamos la información personal, puede ponerse en contacto con nosotros en cualquier momento a través de los medios de contacto proporcionados en nuestro sitio web.
<br><br>
Última actualización: 14/03/2023
      </p>



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