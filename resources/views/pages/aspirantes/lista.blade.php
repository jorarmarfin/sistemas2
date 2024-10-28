@extends('layouts.default')

@section('title', 'Operaciones Ingresadas')


@section('vendor-style')
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endsection


@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Operaciones Ingresadas</h5>
        </div>
        <div class="card-body">
          <div class="row">
            {!! Form::mtext('num_doc_estu',null,'Nun. Doc. Estudiante',$errors,4,false) !!}

            {!! Form::mselect2('promociones',[],null,'Tipo Promociones',$errors,4,false,false) !!}

            {!! Form::mdate('fecha_inicio', null,'Fecha Inicio',$errors,4,false) !!}
          </div>
          <div class="row">
            {!! Form::mselect2('tipo_operacion',$tipos_operacion,null,'Tipo Operación',$errors,4,false,false) !!}
            
            {!! Form::mselect2('horarios',[],null,'Horario',$errors,4,false,false) !!}

            {!! Form::mselect2('estado_registro',$estados,null,'Estado Registro',$errors,4,false,false) !!}
          </div>
          <div class="row mt-3 text-center">
            <div class="col-4 dt-buttons mb-2">
              <a href="#" class="dt-button create-new btn btn-primary text-white">
                  <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Nuevo Becado</span></span>
              </a>  
            </div>
          </div>
          <div class="table-responsive">
            <table id="rows_items" class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Identificación</th>
				  <th>Cursos</th>
                  <th>Promoción</th>
                  <th>Horario</th>
                  <th>Fecha Inicio</th>
                  <th>Tipo Operación</th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card -->
    <!-- /.content -->
@endsection

@section('vendor-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.js"></script>
@endsection

@section('page-script')
      <script>
        $('.select2').select2();

        $(document).ready(function() {
            var table = $('#rows_items').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                  url: "{{route('aspirantes.lista')}}",
                  data: function(d){
                    d.tipo_operacion = $('#tipo_operacion').val(),
                    d.estado_registro = $('#estado_registro').val(),
                    d.documento = $('#num_doc_estu').val()
                  }
                },
                dom: 'Bfrtip',
                buttons: [
                  'excel'
                ],
                language: {
                    url: "{{ asset('assets/json/datatable-es.json')}}",
                },
                columns: [
                    {data: 'id', name: 'Id'},
                    {data: 'nombres', name: 'nombres', orderable: true},
                    {data: 'apellidos', name: 'apellidos', orderable: true},
                    {data: 'identificacion', name: 'identificacion', orderable: true},
					{data: 'cursos', name: 'cursos', orderable: true},
                    {data: 'promociones', name: 'promociones', orderable: true},
                    {data: 'horario', name: 'horario', orderable: true},
                    {data: 'fecha_inicio', name: 'fecha_inicio', orderable: true},
                    {data: 'operacion', name: 'operacion', orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

          $('#tipo_operacion').change(function(){
              table.draw();
          });
          $('#estado_registro').change(function(){
              table.draw();
          });
          $('#num_doc_estu').change(function(){
              table.draw();
          });
        });
    </script>
@endsection
