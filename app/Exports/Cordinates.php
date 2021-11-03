<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class Cordinates implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd(session()->get('cordinates'));
        $cordinates = session()->get('cordinates');
        return collect( $cordinates);
    }
}
