<?php

namespace App\Http\Controllers;

use App\Jobs\MassEmailSender;
use App\Mail\TestEmail;
use App\Traits\SendEmailTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Mail\RegistroMatricula;
use Maatwebsite\Excel\Excel;
use App\Imports\CapturaNotas;
use App\Exports\FormatoNotas;
use App\Exports\SeccionAlumno;
use App\Models\Secciones;
use App\Models\Notas;
use App\Models\NotaModulos;
use App\Models\Materia;
use App\Models\Modulos;
use App\Models\Solicitud;
use App\Models\TipoDoc;
use App\Models\Persona;
use App\Models\Alumno;
Use Alert;
use DataTables;
use DB;


class SeccionesController extends Controller
{
    use SendEmailTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 //route:	config/secciones	index
    public function index()
    {
        return view('pages.secciones.lista');
    }

	//route:	config/secciones/lista
    public function index_lista(Request $request){
        $data = Secciones::all();
        if ($request->ajax()){
            return Datatables::of($data)
                    ->addIndexColumn()
					->addColumn('cantidad_inscritos', function($row){

                        return $row->CantAlumn($row->id);
                    })
					 ->addColumn('fecha_creacion', function($row){

                        return $row->created_at;//date_format(date_create($row->created_at),'d/m/Y h:i:s');
                    })
					->addColumn('fecha_inicio', function($row){

                         return $row->fecha_inicio != null ? $row->fecha_inicio->nombre:'';
                    })
                    ->addColumn('action', function($row){
                            $btn = '<div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="'.route('secciones.edit',$row->id).'"><i class="ti ti-edit me-1"></i>Editar</a>
										<a class="dropdown-item" href="'.route('secciones_alumno.create',$row->id).'"><i class="ti ti-user me-1"></i>Agregar Alumno</a>';

                                        if($row->notas->count() != 0){
                                            $btn .= '<a class="dropdown-item" href="#" onclick="save_email('.$row->id.')"><i class="ti ti-send me-1"></i>Correo classroom</a>
                                                    <a class="dropdown-item" href="'.route('secciones_alumno.create',$row->id).'"><i class="ti ti-user me-1"></i>Agregar Alumno</a>
                                                    <a class="dropdown-item" href=" "><i class="fa fa-file-excel me-1"></i>Alumnos</a>
                                                    ';
                                        }

                            $btn .=            '
                                            <a class="dropdown-item" href="'.route('secciones.notas',$row->id).'"><i class="fa fa-upload me-1"></i>Notas</a>
                                            <a class="dropdown-item" href="'.route('bitacora.index',$row->id).'"><i class="fa-solid fa-envelope me-1"></i>Bitacora</a>
                                      </div>
                                    </div>';

                            return $btn;
                    })
                    ->rawColumns(['action','fecha_creacion','fecha_inicio','cantidad_inscritos'])
                    ->make(true);
        }
    }

    public function subir_notas($id) {
        $item = Secciones::find($id);
        return view('pages.secciones.notas',[
            'item' => $item
        ]);
    }
    public function valHeader($curso, $seccion, $seccion_id, $modulo){

    }

    public function getTipoDocumento($nombre){
        $tipo_documento = TipoDoc::where('codigo','=',$nombre)->first();
        return $tipo_documento != null ? $tipo_documento->id : 0;
    }

    public function getDocumento($documento){
        $documento_item = Persona::where('documento','=',$documento)->first();
        return $documento_item != null ? $documento_item->id : 0;
    }

    public function getAlumno($apellidos, $nombres){

        $alumno_val = Persona::where([
            ['apellidos','=',$apellidos],
            ['nombres','=',$nombres],
            ['tipo','=','alumno']
        ])->first();
        return $alumno_val != null ? $alumno_val->id : 0;
    }

    public function valAlumnos($data = [], $seccion_id, $curso_id, $modulo_id){

    }
    public function subir_notas_store(Request $request, $id, Excel $excel){

    }

    public function getMatricula(){
        $numero = DB::table('alumno')->select('numero')->max('numero');

        return $numero != null ? $numero+1 : 1;
    }

    public function addAlumno($nombre, $apellidos, $tipo_documento, $documento){

        return $person->id;
    }

    public function subir_notas_procesar($data = array(), $seccion_id, $curso_id, $modulo_id){

       // return redirect()->route('secciones.index')->withSuccess('Se procesaron '.$contador.' notas con éxito!');
    }

	//route:	name('secciones.alumnos')
	//alias		config/secciones/lista/alumnos/{id}
    public function lista_alumnos($id,Excel $excel){
        $data = Secciones::find($id);
        return $excel->download(new SeccionAlumno($data, $id), 'listado_alumnos'.time().'.xlsx');
    }
    public function registro_alumnos($id){
        $data = Secciones::find($id);
        return view('pages.secciones.lst_alumnos');
        //return $excel->download(new SeccionAlumno($data), 'listado_alumnos'.time().'.xlsx');
    }

    public function formato_notas($id, Excel $excel){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.secciones.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'nombre' => ['required', 'string','unique:secciones'],
            'url_classrom' => ['url'],
            'url_instructivo' => ['url'],
            'codigo_clase' => ['required', 'string'],
        ])->validate();

        Secciones::create([
            'nombre' => $input['nombre'],
            'cantidad_alumnos' => $input['cantidad_alumnos'],
            'url_classrom' => $input['url_classrom'],
            'url_instructivo' => $input['url_instructivo'],
            'fecha_termino' => $input['fecha_termino'],
            'codigo_clase' => $input['codigo_clase']
        ]);

        return redirect()->route('secciones.index')->withSuccess('Registro almacenado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 //route:	secciones_correo.classroom
	 //post('config/secciones/correo/classroom'
    public function correo_classroom(Request $request)
    {
        $input = $request->all();

        $data = Secciones::select('persona.nombres','persona.apellidos','persona.correo','persona.telefono','horarios.nombre as horario',
								'secciones.fecha_inicio_id as secciones_fecha_inicio_id',
                                'secciones.modulo_id as secciones_modulo_id',
                                'secciones.horario_id as secciones_horario_id',
                                'horarios.id as horarios_id',
                                'materia.id as materia_id',
                                'notas.seccion_id as notas_seccion_id',
                                'persona.id as persona_id',
                                'notas.persona_id as notas_persona_id',
                                'fecha_inicio.id as fecha_inicio_id',
									'fecha_inicio.f_inicio','materia.nombre as modulo','secciones.url_classrom','secciones.codigo_clase','secciones.url_instructivo')
                    ->join('notas','notas.seccion_id','=','secciones.id')
                    ->join('persona','persona.id','=','notas.persona_id')
                    ->leftJoin('horarios','horarios.id','=','secciones.horario_id')
                    ->leftJoin('fecha_inicio','fecha_inicio.id','=','secciones.fecha_inicio_id')
                    ->join('materia','materia.id','=','secciones.modulo_id')
                    ->where('secciones.id','=',$input['id'])
                    ->orderBy('persona.nombres','asc')
                    ->take(1)
                    ->get();

        foreach($data as $item){
            if($item->correo != ''){
				 $id = DB::table('bitacora')->insertGetId([
                    'secciones_fecha_inicio_id' => $item->secciones_fecha_inicio_id,
                    'secciones_modulo_id' => $item->secciones_modulo_id,
                    'secciones_horario_id' => $item->secciones_horario_id,
                    'horarios_id' => $item->horarios_id,
                    'materia_id' => $item->materia_id,
                    'notas_seccion_id' => $item->notas_seccion_id,
                    'persona_id' => $item->persona_id,
                    'correo' => $item->correo,
                    'notas_persona_id' => $item->notas_persona_id,
                    'fecha_inicio_id' => $item->fecha_inicio_id,
                    'created_at' => date('Y-m-d')
                ]);
//                Mail::to($item->correo)->send(new RegistroMatricula($item,'Only One Coin  | Inicio de clases','OnlyOneCoin@gmail.com'));
                MassEmailSender::dispatch($item->toArray(),$id);
                #$this->sendBrevoEmail($item,$id);

            }
        }

        return json_encode([
            'success' => true,
            'texto' => 'Correos enviados con éxito!',
            'data' => $data,
            'id' => $input['id']
        ]);
        //return redirect()->route('secciones.index')->withSuccess('Correos enviados con éxito!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Secciones::find($id);

        return view('pages.secciones.form',[
            'edit' => $edit
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
        $input = $request->all();

        Validator::make($input, [
            'url_classrom' => ['url'],
            'url_instructivo' => ['url'],
            'codigo_clase' => ['required', 'string'],
        ])->validate();

        $item = Secciones::find($id);
        $item->url_classrom = $input['url_classrom'];
        $item->url_instructivo = $input['url_instructivo'];
        $item->fecha_termino = $input['fecha_termino'];
        $item->codigo_clase = $input['codigo_clase'];
        $item->save();

        return redirect()->route('secciones.index')->withSuccess('Registro actualizado con éxito!');
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
