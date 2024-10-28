@extends('layouts.default')

@section('title', 'Operación Ingresada')

@section('content')
 <!-- Content Header (Page header) -->
    <!-- Main content -->
      <!-- Default box -->  
      <div class="col-12">
        <div class="card-header">
          <h3 class="card-title">Operación Ingresada</h3>
        </div>
        <div class="nav-align-top nav-tabs-shadow mb-4">
          <ul class="nav nav-tabs nav-fill" role="tablist">
          @if($accion == 'ver')
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link {{$accion == 'ver' ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-infor-personal" aria-controls="navs-infor-personal" aria-selected="true"><i class="tf-icons ti ti-user ti-xs me-1"></i> Información Personal</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-direccion" aria-controls="navs-direccion" aria-selected="false" tabindex="-1"><i class="tf-icons ti ti-home ti-xs me-1"></i> Dirección</button>
            </li>
            @if($edit->disapoderado_nombre != null && $edit->apoderado_apellido != null )
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-apoderado" aria-controls="navs-apoderado" aria-selected="false" tabindex="-1"><i class="tf-icons ti ti-message-dots ti-xs me-1"></i> Apoderados para menor de Edad</button>
            </li>
            @endif
          @else
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cursos" aria-controls="navs-cursos" aria-selected="false" tabindex="-1"><i class="tf-icons ti ti-books ti-xs me-1"></i> Cursos</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link {{$accion == 'validar' ? 'active' : ''}}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-validar-documento" aria-controls="navs-validar-documento" aria-selected="false" tabindex="-1"><i class="tf-icons ti ti-check ti-xs me-1"></i> Validar Documento</button>
            </li>
          @endif
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade {{$accion == 'ver' ? 'active show' : ''}} " id="navs-infor-personal" role="tabpanel">
              <div class="row">
                {!! Form::mtext('nombres',isset($edit) ? $edit->nombres : null,'Nombre(s)',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::mtext('primer_apellidos',isset($edit) ? $edit->primer_apellido : null,'Primer Apellido',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::mtext('segundo_apellidos',isset($edit) ? $edit->segundo_apellido : null,'Primer Apellido',$errors,4,false,true,[['disabled']]) !!}
              </div>
              <div class="row">
                {!! Form::mselect('pais',$paises,isset($edit) ? ($edit->pais_id) : null ,'Pais',$errors,4,false,false,null,true) !!}

                {!! Form::mselect('tipo_documento',$tipo_documento,isset($edit) ? ($edit->id_documento) : null ,'Tipo Documento',$errors,4,false,false,null,true) !!}

                {!! Form::mtext('documento',isset($edit) ? $edit->documento : null,'Documento',$errors,4,true,true,[['disabled']]) !!}
              </div>
              <div class="row">
                {!! Form::mtext('telefono',isset($edit) ? $edit->telefono : null,'Número de Teléfono',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::memail('email',isset($edit) ? $edit->correo : null,'Correo electrónico',$errors,4,true,true,[['disabled']]) !!}

              {!! Form::mselect('sexo',['h'=>'Hombre', 'm' => 'Mujer'],isset($edit) ? $edit->sexo : null,'Sexo',$errors,4,false,false,null,true) !!}
              </div>
              <div class="row">
                {!! Form::mdate('fecha_nacimiento', null,'Fecha de Nacimiento',$errors,4,false,true,[['disabled']]) !!}
              </div>
            </div>
            <div class="tab-pane fade" id="navs-direccion" role="tabpanel">
              <div class="row">
                {!! Form::mtext('domicilio',isset($edit) ? $edit->direccion : null,'Domicilio actual',$errors,12,false,true,[['disabled']]) !!}
              </div>
              <div class="row">
                {!! Form::mselect('departament',$departaments,isset($edit) ? str_pad($edit->departament_id, 2, "0", STR_PAD_LEFT) : null,'Departamento (Domicilio)',$errors,4,true,false,null,true) !!}

                {!! Form::mselect('province',$province,isset($edit) ? str_pad($edit->province_id, 4, "0", STR_PAD_LEFT) : null,'Provincia (Domicilio)',$errors,4,true,false,null,true) !!}

                {!! Form::mselect('distric',$districts,isset($edit) ? $edit->district_id : null,'Distrito (Domicilio)',$errors,4,false,false,null,true) !!}
              </div>
            </div>
            <div class="tab-pane fade" id="navs-apoderado" role="tabpanel">
              <div class="row">
                {!! Form::mtext('apoderado_nombre',isset($edit) ? $edit->disapoderado_nombre : null,'Nombres',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::mtext('apoderado_apellido',isset($edit) ? $edit->apoderado_apellido : null,'Apellidos',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::mselect('relacion',$parentesco,isset($edit) ? $edit->apoderado_relacion : null,'Relación',$errors,4,false,false,null,true) !!}
              </div>
              <div class="row">
                {!! Form::mselect('apoderado_tipo_documento',$tipo_documento,isset($edit) ? $edit->apoderado_tipo_documento : null,'Tipo Documento',$errors,4,false,false,null,true) !!}

                {!! Form::mtext('apoderado_documento',isset($edit) ? $edit->apoderado_documento : null,'Documento',$errors,4,false,true,[['disabled']]) !!}

                {!! Form::mtext('apoderado_telefono',isset($edit) ? $edit->apoderado_telefono : null,'Número de Teléfono',$errors,4,false,true,[['disabled']]) !!}
              </div>
              <div class="row">
                {!! Form::memail('apoderado_correo',isset($edit) ? $edit->apoderado_correo : null,'Correo electrónico',$errors,6,false,true,[['disabled']]) !!}
              </div>
            </div>
             <div class="tab-pane fade" id="navs-cursos" role="tabpanel">
              <div class="row">
                  <div class="table-responsive text-nowrap mt-2">
                      <table class="table">
                          <thead class="table-light">
                              <tr>
                              <th>Curso</th>
                              <th>Promoción</th>
                              <th>Horario</th>
                              <th>Importe a pagar</th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                              @foreach($edit->detalle_solicitud as $item)
                                <tr>
                                  <td>{{ $item->promocion != null ? $item->promocion->materia->nombre : ''}}</td>
                                  <td>{{ $item->promocion != null ? $item->promocion->nombre : ''}}</td>
                                  <td>{{ $item->horario != null ? $item->horario->nombre : ''}}</td>
                                  <td>{{ $item->promocion != null ? $item->promocion->precio : ''}}</td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
            <div class="tab-pane fade {{$accion == 'validar' ? 'active show' : ''}} " id="navs-validar-documento" role="tabpanel">
            {!! Form::model($edit,['route' => ['aspirantes.validar',$edit->id],'method'=>'PATCH','id' => 'frm_validar']) !!}
            <div class="row">
              @php
                $data_archivos = json_decode($edit->archivo);
              @endphp
                <div class="col-5">
                <div class="accordion" id="accordionExample">
                    @foreach($data_archivos as $key => $archivo)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo_{{$key}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo_{{$key}}" aria-expanded="false" aria-controls="collapseTwo_{{$key}}">
                          Adjunto {{$key + 1}}
                        </button>
                      </h2>
                      <div id="collapseTwo_{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <object
                          type="application/pdf"
                          data="{{asset('/uploads/aspirante/documentos').'/'.$archivo->nombre}}"
                          style="width: 500px; height: 650px;">
                          Sin documento
                        </object>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  
                </div>
                <div class="col-7">
                    <div class="row">
                      {!! Form::mtext('nro_operacion',$edit->alumno != null ? $edit->alumno->nro_registro : null,'Nro Operación',$errors,12,true) !!}
                      <input type="hidden" name="proceso" id="proceso" value="validar">
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                          <div class="row @error('tipo_boletar') is-invalid @enderror">
                            <div class="col-4">
                                <div class="form-check mt-2">
                                    {!! Form::radio('tipo_boletar','boletear',isset($edit) ? ($edit->alumno != null ? ($edit->alumno->tipo == 'boletear' ? true : false ) : false) : false ,['class'=>'form-check-input','id'=>'boletear']) !!}
                                    <label class="form-check-label" for="boletear">
                                    Boletear 
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check mt-2">
                                    {!! Form::radio('tipo_boletar', 'no_boletaer', isset($edit) ? ($edit->alumno != null ? ($edit->alumno->tipo == 'no_boletaer' ? true : false ) : false) : false,['class'=>'form-check-input','id'=>'no_boletaer']) !!}
                                    <label class="form-check-label" for="no_boletaer">
                                    No Boletear
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check mt-2">
                                    {!! Form::radio('tipo_boletar', 'no_boletear_becado', isset($edit) ? ($edit->alumno != null ? ($edit->alumno->tipo == 'no_boletear_becado' ? true : false ) : false) : false,['class'=>'form-check-input','id'=>'no_boletear_becado']) !!}
                                    <label class="form-check-label" for="no_boletear_becado">
                                    No Boletea, se asume que es becado
                                    </label>
                                </div>
                            </div>
                          </div>
						   @error('tipo_boletar')
                              <div class="invalid-feedback"> <strong>{{ $message }}</strong> </div>
                          @enderror
                        </div>
                    </div>
                    @if($edit->estado == 'pendiente')
                    <div class="row text-center mt-3">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-4">
                            <a onclick="enviar('validar')" class="btn btn-success waves-effect waves-light text-white">Validar</a>
                          </div>
                          <div class="col-4">
                            <a onclick="enviar('cancelar')" class="btn btn-danger waves-effect waves-light text-white">Cancelar</a>
                          </div>
                          <div class="col-4">
                            <a  onclick="enviar('rechazar')" class="btn btn-secondary waves-effect waves-light text-white">Rechazar matricula</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="row mt-3">
						<label class="form-control-label text-color-dark">Ingresa Comentario (opcional)</label>
                        <textarea class="form-control" name="comentario" placeholder="Ingresa Comentario (opcional)"> {{ $edit->comentario }} </textarea>
                    </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-12 mt-2">
                <div class="text-center">
                    <a href="{{ route('aspirantes.index') }}" class="btn btn-info text-white">Listado</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    
@endsection
@section('page-script')
    <script>
       function enviar(proceso){
        $('#proceso').val(proceso);
        document.getElementById("frm_validar").submit();
       }
    </script>
@endsection
