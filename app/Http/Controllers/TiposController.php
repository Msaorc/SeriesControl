<?php

namespace App\Http\Controllers;

use App\Suplemento;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    public function index(int $suplementoID)
    {
        $suplemento = Suplemento::find($suplementoID);
        $tipos = $suplemento->tipos;
        return view('tipos.index',compact('suplemento','tipos'));
    }
}
