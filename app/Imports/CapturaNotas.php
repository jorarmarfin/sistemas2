<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class CapturaNotas implements ToArray
{
    public function array(array $row){
       // dd($collection->toArray());
       return $row;
    }
}
