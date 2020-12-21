<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <title>¡Prueba!</title>
  </head>
  <body>
    <div class="container">
      <h1>Crear empleado</h1>
      @if(session()->has('success'))
        <div class="alert alert-success">
                <span aria-hidden="true">&times;</span>
            {{ session()->get('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">   
                <span aria-hidden="true">&times;</span>
            @foreach ($errors->all() as $error)
            <p class="text-left">{{ $error }}</p>
            @endforeach
        </div>
      @endif
        <form id="form" method="POST"   class="form" action="/registro-process">
          {{csrf_field()}}

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo*</label>
              <input type="text" name="nombre" class="form-control" id="nombre"  required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo eléctronico*</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required data-msg="este email es requerido">
            </div>

            <label for="nombre" class="form-label">Sexo*</label>
            <div class="form-check">
              <input class="form-check-input" name="sexo[]" type="radio" value="m" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Masculino
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" name="sexo[]" type="radio" value="f" id="flexRadioDefault2">
              <label class="form-check-label" for="flexRadioDefault2">
                Femenino
              </label>
            </div>

            <label for="nombre" class="form-label">Área*</label>
            <select class="form-select" name="area"  aria-label="Default select example"  required>
              @foreach($areas as $a)
              <option value="{{$a->id}}">{{$a->nombre}}</option>
              @endforeach
            </select>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Descripción*</label>
              <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>

            <div class="form-check">
              <input class="form-check-input" name="boletin" type="checkbox" value="1" id="flexCheckIndeterminate">
              <label class="form-check-label" for="flexCheckIndeterminate">
                  Deseo recibir boletín 
              </label>
            </div>

            <label for="nombre" class="form-label">Roles*</label>
            @foreach($roles as $r)
            <div class="form-check">
              <input class="form-check-input" name="rol[]" type="checkbox" value=" {{$r->id}}">
              <label class="form-check-label" for="flexCheckDefault">
                  {{$r->nombre}}
              </label>
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
        <a href="/listar" class="btn btn-primary">Ir a lista</a>

    </div>
    <script>
        $(document).ready(function(){
        jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
      });

          $("#form").validate();
        });
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>