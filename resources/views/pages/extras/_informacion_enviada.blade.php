<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CORREO SINIESTRO</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section>
    <!-- Table row -->
    <div class="row">
      <h4>¡Hola {{$texto->nombres.' '.$texto->apellidos}}!</h4>
      <p>¡Emocionate! Tu clase está confirmada</p>
      <p>¡Anótala en tu calendario para no olvidar!</p>
      <p>Fecha Inicio: <span style="font-weight: bold;">{{date_format(date_create($texto->f_inicio),'d-m-Y')}}</span></p>
      <p>Hora: <span style="font-weight: bold;"> {{$texto->horario}} </span></p>
      <p>Curso: <span style="font-weight: bold;">{{$texto->modulo}}</span></p>
      <table style=" border: #b2b2b2 0.5px solid;">
        <tbody>
          <tr>
            <td>Link de classroom</td>
            <td><a href="{{ $texto->url_classrom }}">Ir a página</a></td>
          </tr>
          <tr>
            <td>Instructivo</td>
            <td><a href="{{ $texto->url_instructivo }}">Ir a instructivo</a></td>
          </tr>
        </tbody>
      </table>
      <p> <span style="font-weight: bold;">IMPORTANTE</span> Haz click en el siguiente enlace para acceder a la platadorma de aprendizaje y crear tu cuenta</p>
      <p> Selecciona <span style="font-weight: bold;">"Primera vez aqui"</span> y llena el formulario con tu nombre, correo electrónico y una contraseña de 6 caracteres o más</p>
      <P>Luego has click en <span style="font-weight: bold;">"Aprender cómo utilizar la plataforma"</span> y mira los tres videos explicativos</P>
      <p>Asi mismo quiero evaluar que tal estuvo tu experiencia en tu inscripción con E4CC. Te tomará 3 minutos de tiempo para poder ayudarnos a mejorar y conocer tu opinión</p>
      <p><a href="{{ asset('/') }}">Solo debes hacer click en el siguiente botón para poder realizarla</a></p>
      <p>Completar Encuesta AHORA</p>
      <p style="font-weight: bold;">Welcome to the OOC family!</p>
      <p>Saludos.</p>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</body>
</html>
