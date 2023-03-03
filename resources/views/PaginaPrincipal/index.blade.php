<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="indexCss/index.Css">


    <title>Pagina principal</title>
</head>
<body>

  <div class="section" id="section-1">
  <a class="a" href="{{route("index2")}}">
    <div class="wrap">
        <h1>COQUETTA BOUTIQUE</h1>
    </div>
  </a>
  </div>


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