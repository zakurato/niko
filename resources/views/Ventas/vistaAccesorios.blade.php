<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("ventasCss/ventas.Css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    
    <title>Ventas Accesorios</title>
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

    <form method="POST" action="{{route("storeComprobanteAccesorios")}}" accept-charset="UTF-8" enctype="multipart/form-data">
      @csrf
          <input style="text-align: center" type="hidden" class=" pEtiquetas" name="imagenTenis" value="{{$productos->imagen}}" readonly><br>
          <input type="hidden" value="{{$productos->id}}" name="id">
          <div class="centrarEtiquetas">
          <div id="collage">
            <button type="button" class="btnImg zoom">
              <img src="{{asset("imagesInventario/$productos->imagen")}}" style="max-width: 400px; height: 70%;">
              <label for="">{{$productos->nombre}}</label>
              <input style="text-align: center" type="text" class=" pEtiquetas" name="precio" value="Precio: ₡{{$tallas->precio}}" readonly>
              <input type="hidden" value="{{$productos->categoria}}" name="categoria">
            </button>
          </div>
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



      <script>
        /*validar no espacios*/
        $("#_texto").keyup(function(){
        let string = $("#_texto").val();
        $("#_texto").val(string.replace(/ /g, ""))
        })
        $("#_textoTelefono").keyup(function(){
        let string = $("#_textoTelefono").val();
        $("#_textoTelefono").val(string.replace(/ /g, ""))
        })
        $("#_textoCorreo").keyup(function(){
        let string = $("#_textoCorreo").val();
        $("#_textoCorreo").val(string.replace(/ /g, ""))
        })
      </script>




      <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
          selElmnt = x[i].getElementsByTagName("select")[0];
          ll = selElmnt.length;
          /*for each element, create a new DIV that will act as the selected item:*/
          a = document.createElement("DIV");
          a.setAttribute("class", "select-selected");
          a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
          x[i].appendChild(a);
          /*for each element, create a new DIV that will contain the option list:*/
          b = document.createElement("DIV");
          b.setAttribute("class", "select-items select-hide");
          for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                  if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                      y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                  }
                }
                h.click();
            });
            b.appendChild(c);
          }
          x[i].appendChild(b);
          a.addEventListener("click", function(e) {
              /*when the select box is clicked, close any other select boxes,
              and open/close the current select box:*/
              e.stopPropagation();
              closeAllSelect(this);
              this.nextSibling.classList.toggle("select-hide");
              this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
          /*a function that will close all select boxes in the document,
          except the current select box:*/
          var x, y, i, xl, yl, arrNo = [];
          x = document.getElementsByClassName("select-items");
          y = document.getElementsByClassName("select-selected");
          xl = x.length;
          yl = y.length;
          for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
              arrNo.push(i)
            } else {
              y[i].classList.remove("select-arrow-active");
            }
          }
          for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
            }
          }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
        </script>
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