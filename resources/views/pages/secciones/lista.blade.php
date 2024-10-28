@extends('layouts.default')

@section('title', 'Secciones')


@section('vendor-style')
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endsection


@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">SeccionesXR</h5>
        </div>
        <div class="card-body">
          <div class="dt-buttons mt-2 mb-2">
            <a href="{{ route('secciones.create') }}" class="dt-button create-new btn btn-primary text-white">
                <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Nuevo</span></span>
            </a>
          </div>
          <div class="table-responsive">
            <table id="rows_items" class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
				  <th>Fecha y Hora creación</th>
				  <th>Fecha Inicio</th>
                  <th>Cantidad Alumno</th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>


      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                  <div class="col-mb-12 text-center" id="proceso" style="display: block;">
                    <h4> Enviando correo, favor de esperar...</h4>
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                  <div class="col-mb-12 text-center" id="correcto" style="display: none;">
                    <h4 class="text-success"> Correos enviados correctamente</h4>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ok</button>
                  </div>
                  <div class="col-mb-12 text-center" id="error_proceso" style="display: none;">
                    <h4 class="text-danger"> Error al procesar los correos</h4>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ok</button>
                  </div>
              </div>
            </div>
          </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
      <script>
        $(document).ready(function() {
            var table = $('#rows_items').DataTable({
                processing: false,
                serverSide: false,
                ajax: "{{route('secciones.lista')}}",
                language: {
                    url: "{{ asset('assets/json/datatable-es.json')}}",
                },
				dom: 'Bfrtip',
                buttons: [
                  'excel'
                ],
                language: {
                    url: "{{ asset('assets/json/datatable-es.json')}}",
                },
                columns: [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'fecha_creacion'},
                    {data: 'fecha_inicio'},
                    {data: 'cantidad_inscritos'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function save_email(id){

		  var proceso = document.getElementById('proceso');
          var correcto = document.getElementById('correcto');
          var error_proceso = document.getElementById('error_proceso');
          correcto.style.display = 'none';
          error_proceso.style.display = 'none';
          proceso.style.display = 'block';


          Swal.fire({
            title: '¿Desea enviar el mensaje a los alumnos?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI',
            cancelButtonText: 'NO'
          }).then((result) => {
            if (result.value) {
				$('#staticBackdrop').modal('show');

              $.ajax({
                type: "POST",
                url: "{{route('secciones_correo.classroom')}}",
                data: { "_token": "{{ csrf_token() }}", id: id },
                success: function (res) {

                    if(res.success){
						proceso.style.display = 'none';
                      correcto.style.display = 'block';
                    }else{
						proceso.style.display = 'none';
						correcto.style.display = 'none';
						error_proceso.style.display = 'block';
					}
                },
                dataType: "json"
                });
            }
          })
          console.log(id);
        }
    </script>
@endsection
