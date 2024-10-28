<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SeccionAlumno implements FromView
{
    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View{
        return view('pages.secciones.lst_alumnos',['data'=>$this->data]);
    }
}
