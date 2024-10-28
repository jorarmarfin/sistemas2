<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormatoNotas implements FromView
{
    public function __construct($data, $seccion){
        $this->data = $data;
        $this->seccion = $seccion;
    }

    public function view(): View{
        return view('pages.reportes.formato_notas',['data'=>$this->data,'seccion'=>$this->seccion]);
    }
}
