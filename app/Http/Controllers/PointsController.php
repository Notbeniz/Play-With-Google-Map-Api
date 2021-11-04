<?php

namespace App\Http\Controllers;

use App\Exports\Cordinates;
use App\Imports\PointsImport;
use App\Models\Point;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PointsController extends Controller
{
    public function import(Request $request)
    {
        $points = Excel::toArray(new PointsImport, $request->file('excel'));
        foreach ($points as $point) {

            foreach ($point as $data => $value) {
                $cordinates []= ['address' => $value['address'], 'lat' => $value['lat'], 'long' => $value['long']];
 
            }
         $request->session()->put('cordinates', $cordinates);
        }
        return view('map', compact('cordinates'));
    }

    public function getDirection(Request $request)
    {
        if(! empty(session()->get('cordinates'))){

            $loc= ["lat" => $request['lat'] ,"long" => $request['lng']];
            $locations = $this->distance($loc);
           
            return view('direction', compact('locations','loc'));
        } else {
            return back()->with('session_empty', 'frist upload excel file');
        }
    }

    public function distance($loc)
    {
        $mylist = session()->get('cordinates');
        $cordinates = session()->get('cordinates');
        // $data [] = $loc;
          for($i=0; $i< count($mylist); $i++ )  {
            $num = 0;
            foreach($cordinates as $key=>$cordinate) {
                
                $distance= sqrt(pow($loc['lat']-$cordinate['lat'],2) + (pow($loc['long']-$cordinate['long'],2)));
                if($distance < $num) {
                    $num = $distance;
                    $index = $key;
                } elseif($num == 0) {
                    $num = $distance;
                    $index = $key;
                } 
            }
        
        $loc = $cordinates[$index];
        $data [] = $cordinates[$index];
        unset($cordinates[$index]);

        }
        // dd($data);
        return $data;
    }


    public function export()
    {
        if(! empty(session()->get('cordinates'))){
            return Excel::download(new Cordinates, 'Cordinates.xlsx');
        } else {
            return back()->with('session_empty', 'frist upload excel file');
        }
    }


}
