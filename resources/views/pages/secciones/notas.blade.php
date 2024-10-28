@extends('layouts.default')

@section('title', 'Subir Notas')

@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
    
    {!! Form::open(['route' => ['secciones_notas.store',$item->id],'method'=>'post','enctype'=>'multipart/form-data']) !!}
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subir Notas</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-hover">
                    <tr>
                        <th>Curso: {{ $item->curso != null ? $item->curso->nombre : 'No definido' }} </th>
                        <th>Horario: {{ $item->horario != null ? $item->horario->horario->nombre : 'No definido' }}</th>
                    </tr>
                    <tr>
                        <th>Promoción: {{ $item->promocion != null ? $item->promocion->nombre : 'No definido' }}</th>
                        <th>Cantidad Alumnos: {{ $item->notas->count() }} </th>
                    </tr>
                </table>
            </div>
           <div class="row mt-3">
            {!! Form::mfile('archivo','Archivo de captura notas',$errors,12,true) !!}
           </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-12 mt-2">
                <div class="text-center">
                    <button class="btn btn-primary">Procesar</button>
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
        
    </script>
@endsection
