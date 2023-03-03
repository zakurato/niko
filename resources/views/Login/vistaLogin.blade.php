<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset("loginCss/login.Css")}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
  integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  
  <title>Login</title>
</head>
<body>
    <div class="section" id="section-1">
      <br>
      <div class="w3-row">
        <div class="wrap"><h1>COQUETTA BOUTIQUE</h1>
      </div>
      <br>
    </div>

    <div class="section" id="section-2">
      <form method="POST" action="{{route("loginAuth")}}" >
        @csrf
      
        <div class="login">
          <div class="login-screen">
            <div class="app-title">
              <h1>Iniciar sesión</h1>
            </div>
            <div class="login-form">
              <div class="control-group">
              <input type="text" name="email" class="login-field" value="{{old("email")}}" placeholder="Correo" required>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              
            </div>
      
              <div class="control-group">
              <input type="password" name="password"class="login-field" placeholder="Contraseña" required>
              @error('password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>
      
              <p>{{session("mensaje")}}</p>
      
              <button class="btnLogin" type="submit" >LOGIN</button>
            </div>
          </div>
        </div>
      </form>

      <br>
      <a href="{{route("index2")}}">
        <button class="btnVolver" type="button" >Volver</button>
      </a>
    </div>
    <br><br><br>

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
        <a href="https://www.coquettaboutique.com/politica-de-privacidad" style="color: white">Política de privacidad</a></p>
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
</html>