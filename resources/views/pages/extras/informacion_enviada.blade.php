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
    <div style="background-color:#f3f6f8;height:100%;width:900px;text-justify: auto;">
	  <p style="font-size: 20px;">Estimado alumno {{$texto->nombres.' '.$texto->apellidos}} informarle que su matrícula es procesada con éxito, por favor de unirse al siguiente link</p>
	 
	  <p style="font-size: 20px;font-weight: bolder;">Datos del estudiante:</p>
      <p style="font-size: 20px;">Nombre del Estudiante: {{$texto->nombres.' '.$texto->apellidos}}</p>
	  <p style="font-size: 20px;">Número de contacto: {{$texto->telefono}}</p>
	  <p style="font-size: 20px;font-weight: bolder;">Información de clase:</p>     
      <p style="font-size: 20px;">Clase: {{$texto->modulo}} </p>
	  <p style="font-size: 20px;">Horario: {{$texto->horario}} </p>
	  <p style="font-size: 20px;">Fecha de Inicio: {{date_format(date_create($texto->f_inicio),'d-m-Y')}} </p>	   
      <p style="font-size: 20px;">Link de Classroom: <a href="{{ $texto->url_classrom }}"  style="font-weight: bold;">{{ $texto->url_classrom }}</a></p>	  
      <p style="font-size: 20px;">CÓDIGO DE CLASE: {{$texto->codigo_clase}} </p>
	  
	  <p style="font-size: 21px;font-weight: bolder;">Recuerde que es obligatorio el unirse al classroom, ya que TODO se publicará por ese medio. Es d instrucciones.</p>
      <p>EL CAMBIO DE HORARIO TIENE UN COSTO DE S/10.00 SOLES ASÍ QUE FAVOR DE REVISAR BIEN</p>
      <p>PARA TRANSFERENCIA A OTRA PERSONA SOLO SE PERMITE HASTA 3 DÍAS DESPUÉS DE EMPEZAR</p>
      <p>SI DESEA CONGELAR SU MATRÍCULA SÓLO ES POSIBLE POR TRES MESES Y DEBE PAGAR S/10.</p>
      <p>LOS EXÁMENES SON OBLIGATORIOS Y NO SON REPROGRAMABLES, SOLO POR TEMAS MÉDICO</p>
      <p>ALUMNO ESTAR INFORMADO DE LAS FECHAS Y DURACIÓN DE LAS EVALUACIONES</p>
      <p>RECUERDE: EL PAGO ES NO REEMBOLSABLE, SÓLO TRANSFERIBLE</p>
	  
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</body>
</html>
