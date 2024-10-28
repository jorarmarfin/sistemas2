<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Secciones;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function index($id)
    {
        $bitacoras = Bitacora::where('notas_seccion_id',$id)->get();
        return view('pages.bitacoras.index',[
            'bitacoras' => $bitacoras,
            'seccion' => Secciones::where('id',$id)->first()
        ]);
    }

}
