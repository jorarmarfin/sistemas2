@extends('layouts.default')

@section('title', 'Subir Notas')

@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
    
    {!! Form::open(['route' => 'secciones_notas.procesar','method'=>'post']) !!}
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Validar Proceso de Notas</h3>
        </div>
        <div class="card-body">
        <div class="row">
                <table class="table table-hover">
                    <tr>
                        <th>
                            <input type="hidden" name='curso' value="{{ $data_header['curso']['id'] }}">
                            Curso: {{ $data_header['curso']['nombre'] }}
                        </th>
                        <th>
                            <input type="hidden" name='seccion' value="{{ $data_header['seccion']['id'] }}">
                            Sección: {{ $data_header['seccion']['nombre'] }}
                        </th>
                        <th>
                            Comentario: {{ $data_header['seccion']['comentario'].' '.$data_header['curso']['comentario'] }}
                        </th>
                    </tr>
                </table>
            </div>
            @if($contador_errores != 0)
                <div class="row mt-4 bg-danger text-white text-center">
                    <p class="fw-bold">Favor de revisar los comentarios de la lista, se encontraron  {{ $contador_errores }} error(es). <br> 
                    los registros con errores no se procesaron.  </p>
                </div>
            @endif
            <div class="row mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tipo de Docunento</th>
                            <th>Documento</th>
                            <th>Alumno</th>
                            <th>Nota</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_items as $item)
                            <tr class=" {{ !$item['estado'] ? 'bg-danger text-white' : '' }} ">
                                <td> <input type="hidden" name="tipo_documento[]" value="{{ $item['id_tipo_documento'] }} ">
                                    {{ $item['tipo_documento'] }} 
                                </td>
                                <td> <input type="hidden" name="documento[]" value="{{ $item['documento'] }} ">
                                    {{ $item['documento'] }} 
                                </td>
                                <td> 
                                    <input type="hidden" name="id_persona[]" value="{{ $item['id_persona'] }} ">
                                    <input type="hidden" name="nombres[]" value="{{ $item['nombres'] }} ">
                                    <input type="hidden" name="apellidos[]" value="{{ $item['apellidos'] }} ">
                                    <input type="hidden" name="notas[]" value="{{ $item['nota'] }} ">
                                    <input type="hidden" name="estados[]" value="{{ $item['estado'] }} ">
                                    {{ $item['nombre'] }} 
                                </td>
                                <td> {{ $item['nota'] }} </td>
                                <td> {{ $item['comentario'] }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-12 mt-2">
                <div class="text-center">
                    <a href="{{ route('secciones.index') }}" class="btn btn-primary text-white">Listado</a>
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
