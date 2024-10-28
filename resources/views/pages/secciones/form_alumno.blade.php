@extends('layouts.default')

@section('title', 'Sección - Alumno')

@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
    
    {!! Form::open(['route' => ['secciones_alumno.store',$id] ,'method'=>'post']) !!}
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Alumno </h3>
        </div>
        <div class="card-body">
            <div class="row text-center bg-light mt-3">
                <h5>
                    Se agregará al curso {{$data->curso != '' ? $data->curso : ' no definido'}} en el horario {{$data->horario !=  '' ? $data->horario : 'no definido' }} iniciando {{ date_format(date_create($data->f_inicio),'d/m/Y') }} con el plan de pago {{$data->promocion != '' ? $data->promocion : ' no definido'}} {{$data->precio}}
                </h5>
            </div>
           <div class="row mt-2">
             {!! Form::mtext('nombres',isset($edit) ? $edit->nombres : null,'Nombre(s)',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}

             {!! Form::mtext('apellidos',isset($edit) ? $edit->apellidos : null,'Apellidos(s)',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}
           </div>
           <div class="row">
                {!! Form::mselect('id_documento',$tipo_documento,isset($edit) ? ($edit->id_documento) : null ,'Tipo Documento',$errors,6,true,false,null,isset($show) ? true : false) !!}

                {!! Form::mtext('documento',isset($edit) ? $edit->documento : null,'Documento',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}
            </div>
            <div class="row">
                {!! Form::mtext('telefono',isset($edit) ? $edit->telefono : null,'Teléfono',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}

                {!! Form::mtext('correo',isset($edit) ? $edit->correo : null,'Correos Electrónico',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}
            </div>
            <div class="row">
                {!! Form::mdate('fecha_nacimiento',isset($edit) ? $edit->fecha_nacimiento : null,'Fecha Nacimiento',$errors,6,true,true,[[isset($show) ? 'disabled' : '']]) !!}                
            </div>
            <div class="row">
                {!! Form::mselect2('departament',$departaments,null,'Departamento (Domicilio)',$errors,4,true,false,'buscar_province()') !!}

                {!! Form::mselect2('province',[],null,'Provincia (Domicilio)',$errors,4,true,false,'buscar_district()') !!}

                {!! Form::mselect2('distric',[],null,'Distrito (Domicilio)',$errors,4,true,false) !!}
            </div>
            <div class="row">
                {!! Form::mtext('direccion',null,'Dirección',$errors,12,true,true,[[isset($show) ? 'disabled' : '']]) !!}
            </div>
            
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-12 mt-2">
                <div class="text-center">
                    <button class="btn btn-primary">Aceptar</button>
                    <a href="{{ route('secciones.index') }}" class="btn btn-danger text-white">Cancelar</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
      {!! Form::close() !!}
@endsection
@section('page-script')
    <script>
        $('.select2').select2();

         function buscar_province(){
            var departament = $('#departament').val();

            var url= "{{ URL::asset('province/') }}"+"/"+departament;

            $.get(url, function(res) {
                var obj = $.parseJSON(res);

                document.getElementById("province").innerHTML = "<option value='0'>Seleccionar</option>"; 
                for(var i = 0; i < obj.data.length; i++){
                    document.getElementById("province").innerHTML += "<option value='"+obj.data[i].id+"'>"+obj.data[i].name+"</option>"; 
                }
            });
        }

        function buscar_district(){
            var departament = $('#departament').val();
            var province = $('#province').val();

            var url= "{{ URL::asset('district/') }}"+"/"+departament+'/'+province;

            $.get(url, function(res) {
                var obj = $.parseJSON(res);

                document.getElementById("distric").innerHTML = "<option value='0'>Seleccionar</option>"; 
                for(var i = 0; i < obj.data.length; i++){
                    document.getElementById("distric").innerHTML += "<option value='"+obj.data[i].id+"'>"+obj.data[i].name+"</option>"; 
                }
            });
        }
    </script>
@endsection
