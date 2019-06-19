<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\ControladorPrincipal as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ControladorPrincipal extends Controller
{

    //Creacion del metodo index
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        return view('/');
    }
}
