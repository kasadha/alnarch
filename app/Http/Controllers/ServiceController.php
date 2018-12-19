<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Contactheader;
use App\Nav;
use App\Logo;

class ServiceController extends Controller
{
    public function services(){
        $services = Service::all();
        $contactheaders = Contactheader::all();
        $navs = Nav::all();
        $logos = Logo::all();
        return view('pages.services',compact('services','contactheaders','navs','logos'));

    }

}
