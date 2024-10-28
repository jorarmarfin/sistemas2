@extends('layouts.default')

@switch($tipo)
                @case('validado')
                    @section('title', 'Lista Solicitudes Validadas')
                    @break;
                @case('rechazado')
                    @section('title', 'Lista Solicitudes Rechazadas')
                    @break;
            @endswitch   




@section('vendor-style')
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endsection


@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header border-bottom">
            @switch($tipo)
                @case('validado')
                        <h5 class="card-title mb-3">Lista Solicitudes Validadas</h5>
                    @break;
                @case('rechazado')
                        <h5 class="card-title mb-3">Lista Solicitudes Rechazadas</h5>
                    @break;
            @endswitch           
        </div>
        <div class="card-body">
          <div class="table-responsive mt-2">
            <table id="rows_items" class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombres</th>
                  <th>Primer Apellido</th>
                  <th>Segundo Apellido</th>
                  <th>Tipo Documento</th>
                  <th>Fecha Inicio</th>
                  <th>Documento</th>
                  <th>Correo</th>
                  <th>Fecha Nacimiento</th>
                  <th>Curso</th>
                  <th>Promoción</th>
                  <th>Horario</th>
                  <th>Tipo Operación</th>
                  <th>Importe a Pagar</th>
                  <th>Modalidad</th>
                  <th>RUC</th>
                  <th>Nro. Operación</th>
                  <th>Tipo Boleteo</th>
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
        $(document).ready(function() {
            var table = $('#rows_items').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('solicitudes.lista',$tipo)}}",
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            //columns: ':not(.noVis)',
                            //columns: ':visible'
                            //columns:['id','nombres']
                            modifier: {
                                page: 'all'
                            }
                        }
                    }
                ],
                language: {
                    url: "{{ asset('assets/json/datatable-es.json')}}",
                },
                columns: [
                    {data: 'id'},
                    {data: 'nombres'},
                    {data: 'primer_apellido'},
                    {data: 'segundo_apellido'},
                    {data: 'tipo_documento'},
                    {data: 'fecha_inicio'},
                    {data: 'documento'},
                    {data: 'correo'},
                    {data: 'fecha_nacimiento', visible: false},
                    {data: 'curso', visible: false},
                    {data: 'promocion', visible: false},
                    {data: 'horario', visible: false},
                    {data: 'tipo_operacion', visible: false},
                    {data: 'importe', visible: false},
                    {data: 'modalidad_facturacion', visible: false},
                    {data: 'ruc', visible: false},
                    {data: 'nro_registro', visible: false},
                    {data: 'tipo_boleteo', visible: false},
                ]
            });
        });
    </script>
@endsection
