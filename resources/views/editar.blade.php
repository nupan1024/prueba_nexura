<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/fontawesome-free-5.6.1-web/css/all.css') }}">
    <title>¡Prueba!</title>
  </head>

  <body>

    <div class="container">
      <h1>Actualizar empleado</h1>
      @if(session()->has('success'))
        <div class="alert alert-success">
          <span aria-hidden="true">&times;</span>
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
              
      <form method="POST"   class="form" action="/editar-process">
        {{csrf_field()}}
        <input type="hidden" name="id" class="form-control" id="nombre" value="{{$empleado->id}}" required>

          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo*</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{$empleado->nombre}}" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Correo eléctronico*</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$empleado->email}}"placeholder="name@example.com" required>
          </div>

          <label for="nombre" class="form-label">Sexo*</label>
          <div class="form-check">
            <input class="form-check-input" name="sexo[]" type="radio" name="flexRadioDefault" value="m" id="flexRadioDefault1" @if($empleado->sexo == 'm')  checked @endif>
            <label class="form-check-label" for="flexRadioDefault1">
              Masculino
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" name="sexo[]" type="radio" name="flexRadioDefault" value="f" id="flexRadioDefault2" @if($empleado->sexo == 'f')  checked @endif>
            <label class="form-check-label" for="flexRadioDefault2">
              Femenino
            </label>
          </div>

          <label for="nombre" class="form-label">Área*</label>
          <select class="form-select" name="area"  aria-label="Default select example"  required>
            @foreach($areas as $a)
            <option value="{{$a->id}}" @if($empleado->area_id == $a->id)  selected @endif>{{$a->nombre}}</option>
            @endforeach
          </select>
          


          <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Descripción*</label>
          <textarea class="form-control"  name="descripcion" id="exampleFormControlTextarea1" rows="3" required>{{$empleado->descripcion}}</textarea>
          </div>

          <div class="form-check">
            <input class="form-check-input" name="boletin" type="checkbox" value="1" id="flexCheckIndeterminate" @if($empleado->boletin == 1)  checked @endif>
            <label class="form-check-label" for="flexCheckIndeterminate">
                Deseo recibir boletín 
            </label>
          </div>

          <label for="nombre" class="form-label">Roles*</label>
          @foreach($roles as $r)
          <div class="form-check">
            <input class="form-check-input" name="rol[]" type="checkbox" value=" {{$r->id}}" id="flexCheckDefault"@if(in_array($r->id,$rol))  checked @endif >
            <label class="form-check-label" for="flexCheckDefault">
                {{$r->nombre}}
            </label>
          </div>
          @endforeach
          <button type="submit" class="btn btn-primary">Actualizar</button>

      <form>
        <a href="/listar" type="botton" class="btn btn-primary">Ir a lista</a>
        <a href="/" type="botton" class="btn btn-primary">Ir a crear</a>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
 
  </body>

</html>