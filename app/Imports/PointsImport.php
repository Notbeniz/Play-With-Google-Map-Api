<?php

namespace App\Imports;

use App\Point;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PointsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Point([
            'address' => $row['address'],
            'lat' => $row['lat'],
            'long' => $row['long']
        ]);
    }
}
