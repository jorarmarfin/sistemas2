@extends('layouts.default')

@section('title', 'Fechas Inicio')


@section('vendor-style')
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endsection

 dddddd
@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Lista Fechas Inicio</h5>
        </div>
        <div class="card-body">
          <div class="dt-buttons mt-2 mb-2"> 
            <a href="{{ route('fechas.create') }}" class="dt-button create-new btn btn-primary text-white">
                <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Nuevo</span></span>
            </a> 
          </div>
          <div class="table-responsive">
            <table id="rows_items" class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Fecha Inicio Inscripción</th>
                  <th>Fecha Fin Inscripción</th>
                  <th>Fecha Inicio Clases</th>
                  <th>Max Alumnos</th>                 
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card -->
    <!-- /.content -->
    <div class="modal fade" id="modal-clave11">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cambiar Clave</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                            <label for="password">Clave</label>
                            <div class="input-group mb-3">
                              <input type="hidden" id="usuario" value="0">
                              <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Clave') }}" required autocomplete="current-password" autocomplete="off">
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <span class="fas fa-lock"></span>
                                </div>
                              </div>
                              @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                        </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <a onclick="save()" class="btn btn-primary text-white">Aceptar</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
                ajax: "{{route('fechas.lista')}}",
                language: {
                    url: "{{ asset('assets/json/datatable-es.json')}}",
                },
                columns: [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'f_inicio'},
                    {data: 'f_cierre'},
                    {data: 'f_limite'},
                    {data: 'cantidad_alumno'},                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            table.on( 'order.dt search.dt', function () {
              table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
            } ).draw();
        });
    </script>
@endsection
