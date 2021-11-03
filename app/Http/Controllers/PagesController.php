<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        session()->forget('cordinates');
        return view('index');
    }
}
