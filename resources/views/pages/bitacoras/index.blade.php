@extends('layouts.default')

@section('title', 'Bitacora')


@section('vendor-style')
    <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Bitacora de la sección {{$seccion->nombre}}</h5>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="rows_items" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sección</th>
                        <th>Persona</th>
                        <th>Email</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacoras as $bitacora)
                        <tr>
                            <td>{{$bitacora->id}}</td>
                            <td>{{$seccion->nombre}}</td>
                            <td>{{$bitacora->persona->nombres}} {{$bitacora->persona->apellidos}}</td>
                            <td>{{$bitacora->persona->correo}}</td>
                            <td>
                                @if(is_array(json_decode($bitacora->email_status, true)))
                                    <ul>
                                        @foreach(json_decode($bitacora->email_status, true) as $status)
                                            <li>{{ $status['status'] }} - {{ $status['date'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    No hay estados
                                @endif
                            </td>
                            <td>{{$bitacora->updated_at }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#rows_items').DataTable({
                processing: false,
                serverSide: false,
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

            });
        });


    </script>
@endsection

