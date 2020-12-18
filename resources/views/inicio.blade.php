<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <title>¡Prueba!</title>
  </head>
  <body>
  <div class="container">

    <h1>Crear empleado</h1>

    @if(session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
        <input class="form-check-input" name="sexo[]" type="radio" name="flexRadioDefault" value="m" id="flexRadioDefault1" >
        <label class="form-check-label" for="flexRadioDefault1">
          Masculino
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" name="sexo[]" type="radio" name="flexRadioDefault" value="f" id="flexRadioDefault2" >
        <label class="form-check-label" for="flexRadioDefault2">
          Femenino
        </label>
      </div>

        <label for="nombre" class="form-label">Área*</label>
        <select class="form-select" name="area"  aria-label="Default select example" required>
        <option value="1">Administración</option>
        <option value="2">Finanzas</option>
        <option value="5">Producción</option>
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
        <div class="form-check">
        <input class="form-check-input" name="rol[]" type="checkbox" value="10" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Profesional de proyectos- Desarrollador
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" name="rol[]" type="checkbox" value="9" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
        Gerente estratégico
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" name="rol[]" type="checkbox" value="13" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
        Auxiliar administrativo
        </label>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>

    <form>
    <a href="/listar" type="botton" class="btn btn-primary">Ir a lista</a>

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
    

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>