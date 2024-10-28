@extends('layouts.default')

@section('title', 'Sección')

@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
    
        @if(isset($edit))
          {!! Form::model($edit,['route' => ['secciones.update',$edit->id],'method'=>'PATCH']) !!}
        @else
          {!! Form::open(['route' => 'secciones.store','method'=>'post']) !!}
        @endif
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sección</h3>
        </div>
        <div class="card-body">
           <div class="row">
                {!! Form::mtext('nombre',isset($edit) ? $edit->nombre : null,'Nombre',$errors,6,true,true,isset($edit) ? [['disabled']] : []) !!}

                {!! Form::mnumber('cantidad_alumnos',isset($edit) ? $edit->cantidad_alumnos : null,'Cantidad Alumnos',$errors,6,true,true,isset($edit) ? [['disabled']] : []) !!}
           </div>
            <div class="row">
                {!! Form::mtext('url_classrom',isset($edit) ? $edit->url_classrom : null,'URL Classrom',$errors,6,true) !!}

                {!! Form::mtext('url_instructivo',isset($edit) ? $edit->url_instructivo : null,'Instructivo de como ingresar',$errors,6,true) !!}
            </div>
            <div class="row">
                {!! Form::mtext('codigo_clase',isset($edit) ? $edit->codigo_clase : null,'Código Clase',$errors,6,true) !!}
            </div>
            <div class="row">
                 {!! Form::mdate('fecha_termino',isset($edit) ? $edit->fecha_termino : null,'Fecha termino',$errors,6,false) !!}
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
    </script>
@endsection
