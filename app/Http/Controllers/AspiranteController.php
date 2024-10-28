<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\EstadoSolicitud;
use App\Mail\SolicitudRechazada;
use App\Models\Alumno;
use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\Paises;
use App\Models\Parentesco;
use App\Models\Direccion;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Alert;
use DB;
use Mail;

class AspiranteController extends Controller
{
    public function getMatricula(){
        $numero = DB::table('alumno')->select('numero')->max('numero');
       
        return $numero != null ? $numero+1 : 1;
    }

    public function getTipoOperacion($index = null){
        $data = [
            'matricula' => 'Matricula',
            'continuidad' => 'Continuación'
        ];
        return $index != null ? $data[$index] : $data;
    }

    public function getEstado($index = null){
        $data = [
            'validado'=> 'Validado',
            'rechazado'=>'Rechazado'
        ];
        return $index != null ? $data[$index] : $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_operacion = $this->getTipoOperacion();
        $estados = $this->getEstado();

        return view('pages.aspirantes.lista',[
            'tipos_operacion' => $tipos_operacion,
            'estados' => $estados
        ]);
    }

    public function index_lista(Request $request){
        $input = $request->all();

        $data = Solicitud::where('estado','=','pendiente')->latest();

        if ($request->ajax()){
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('operacion', function($row){
                        return $this->getTipoOperacion($row->tipo);
                    })
                    ->addColumn('apellidos', function($row){

                        return $row->primer_apellido.' '.$row->segundo_apellido;
                    })
                    ->addColumn('identificacion', function($row){

                        return $row->tipo_doc->codigo.':<br>'.$row->documento;
                    })
					 ->addColumn('cursos', function($row){
                        $lista_curso = '<ol>';
                        foreach($row->detalle_solicitud as $item){
                            $lista_curso .= '<li>'.($item->promocion != null ? $item->promocion->materia->nombre : '').'</li>';
                        }
                        $lista_curso .= '</0l>';
                        return $lista_curso;
                    })
                    ->addColumn('promociones', function($row){
                        $lista = '<ol>';
                        foreach($row->detalle_solicitud as $item){
                            $lista .= '<li>'.($item->promocion != null ? $item->promocion->nombre : '').'</li>';
                        }
                        $lista .= '</0l>';
                        return $lista;
                    })
                    ->addColumn('horario', function($row){
                        $lista = '<ol>';
                        
                       foreach($row->detalle_solicitud as $item){
                            $lista .= '<li>'.($item->horario != null ? $item->horario->nombre : '').'</li>';
                        }
                        $lista .= '</ol>';
                        return $lista;
                    })
                    ->addColumn('fecha_inicio', function($row){
                        return $row->fecha_inicio->nombre;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="'.route('aspirantes.edit',[$row->id,'ver']).'"><i class="ti ti-eye me-1"></i>Ver</a>';
                                       
                                        if($row->estado == 'pendiente'){
                                            $btn .= '<a class="dropdown-item" href="'.route('aspirantes.edit',[$row->id,'validar']).'"><i class="ti ti-check me-1"></i>Validar</a>';
                                        }
                            $btn .=   '
                                      </div>
                                    </div>';
    
                            return $btn;
                    })
                    ->filter(function ($query) use ($request){
                        if($request->get('tipo_operacion') != ''){
                            $query->where('tipo','=', $request->get('tipo_operacion'));
                        }
                        if($request->get('estado_registro') != ''){
                            $query->where('estado','=', $request->get('estado_registro'));
                        }
                        if($request->get('documento') != ''){
                            $query->where('documento','=', $request->get('documento'));
                        }
                    })
                    ->rawColumns(['action','apellidos','promociones','identificacion','horario','fecha_inicio','operacion','cursos'])
                    ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function validar(Request $request, $id){
        $input = $request->all();
       
        $contador = $this->getMatricula();
        $item_solicitud = Solicitud::find($id);       

        if($input['proceso'] == 'validar'){

            Validator::make($input, [
                'nro_operacion' => ['required', 'unique:alumno,nro_registro'],
				 'tipo_boletar' => ['required'],
            ])->validate();

            $item_persona = Persona::create([
                'nombres' => $item_solicitud->nombres,
                'apellidos' => $item_solicitud->primer_apellido.' '.$item_solicitud->segundo_apellido,
                'id_documento' => $item_solicitud->id_documento,
                'documento' => $item_solicitud->documento,
                'telefono' => $item_solicitud->telefono,
                'tipo' => 'alumno',
                'sexo' => $item_solicitud->sexo,
                'correo' => $item_solicitud->correo,
                'fecha_nacimiento' => $item_solicitud->fecha_nacimiento,
            ]);
            
            Direccion::create([
                'persona_id' => $item_persona->id,
                'departament' => $item_solicitud->departament_id,
                'province'=> $item_solicitud->province_id,
                'district'=> $item_solicitud->district_id,
                'direccion' => $item_solicitud->direccion,
            ]);
           
            $matricula = 'A'.str_pad($contador, 5, "0", STR_PAD_LEFT);
    
            Alumno::create([
                'alumno_id' => Str::random(30),
                'persona_id' => $item_persona->id,
                'solicitud_id' => $id,
                'ocupacion_id' => $item_solicitud->ocupacion_id,
                'matricula' => $matricula,
                'numero' => $contador,
                'estado' => 'nuevo',
                'nro_registro' => $input['nro_operacion'],
                'tipo' => isset($input['tipo_boletar']) ? $input['tipo_boletar'] : null
            ]);
           
            $item_solicitud->estado = 'validado';
            $item_solicitud->save();

            Mail::to($item_solicitud->correo)->send(new EstadoSolicitud($item_solicitud,'Estado de Matricula','educacion@gmail.com'));

            return redirect()->route('aspirantes.index')->withSuccess('Número almacenado con éxito!');

        }else if($input['proceso'] == 'rechazar'){

            $item_solicitud->estado = 'rechazado';
			$item_solicitud->comentario = $input['comentario'];
            $item_solicitud->save();
			
			$archivos = [];
            if($item_solicitud->archivo != null){
                $archivos = json_decode($item_solicitud->archivo);
            }
			
            Mail::to($item_solicitud->correo)->send(new SolicitudRechazada($item_solicitud,'Matricula Rechazada','educacion@gmail.com',$archivos));

            return redirect()->route('aspirantes.index')->withSuccess('Matricula rechazada con éxito!');
        }
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $accion)
    {
        
        $edit = Solicitud::find($id);
        $paises = Paises::getPaises();
        $tipo_documento = DB::table('tipo_doc')->pluck(DB::raw("concat(codigo,'-',nombre) as nombre"),'id');
       
        $departaments = DB::table('ubigeo_peru_departments')->pluck('name','id');
        
        $province = DB::table('ubigeo_peru_provinces')->where('id','=',str_pad($edit->province_id, 4, "0", STR_PAD_LEFT))->pluck('name','id');
      
        if($edit->district_id != null){
            $districts = DB::table('ubigeo_peru_districts')->where('id','=',$edit->district_id)->pluck('name','id');
        }else{
            $districts = [];
        }
        
       
        $parentesco = Parentesco::getParentesco();
       
        return view('pages.aspirantes.form',[
            'edit' => $edit,
            'paises' => $paises,
            'tipo_documento' => $tipo_documento,
            'departaments' => $departaments,
            'province' => $province,
            'districts' => $districts,
            'parentesco' => $parentesco,
            'accion' => $accion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
