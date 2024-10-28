<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use DataTables;
use DB;

class SolicitudController extends Controller
{
    public function getTipo($tipo){
        $data = [
            'validado'=> 'Validado',
            'rechazado'=>'Rechazado'
        ];
        return $data[$tipo];
    }
    public function getTipoOperacion($index = null){
        $data = [
            'matricula' => 'Matricula',
            'continuidad' => 'Continuación'
        ];
        return $index != null ? $data[$index] : $data;
    }

    public function index_lista(Request $request, $tipo){

        $data = Solicitud::where('estado','=',$tipo)->get();

        if ($request->ajax()){
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('tipo_documento', function($row){
                        return $row->tipo_doc != null ? $row->tipo_doc->nombre : '';
                    })                   
                    ->addColumn('fecha_inicio', function($row){
                        return $row->fecha_inicio != null ? $row->fecha_inicio->nombre : '';
                    })
                    ->addColumn('curso', function($row){
                        $lista = '<ol>';
                        foreach($row->detalle_solicitud as $item){
                            $lista .= '<li>'.($item->promocion != null ? $item->promocion->materia->nombre : '').'</li>';
                        }
                        $lista .= '</0l>';
                        return $lista;
                    })
                    ->addColumn('promocion', function($row){
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
                        $lista .= '</0l>';
                        return $lista;
                    })
                    ->addColumn('tipo_operacion', function($row){
                        return $this->getTipoOperacion($row->tipo);
                    })
                    ->addColumn('importe', function($row){
                        $importe = 0;
                        foreach($row->detalle_solicitud as $item){
                            $importe += ($item->promocion != null ? $item->promocion->precio : 0);
                        }
                        return $importe;
                    })
                    ->addColumn('tipo_boleteo', function($row){
                        return $row->alumno != null ?  $row->alumno->tipo: '';
                    })
                    ->addColumn('nro_registro', function($row){
                        return $row->alumno != null ?  $row->alumno->nro_registro: '';
                    })
                    ->rawColumns(['tipo_documento','fecha_inicio','curso','promocion','horario','tipo_operacion','importe','tipo_boleteo','nro_registro'])
                    ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('pages.solicitudes.lista',[
            'tipo' => $tipo
        ]);
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
    public function edit($id)
    {
        //
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
