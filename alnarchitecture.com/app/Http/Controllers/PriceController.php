<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Requestq;
use App\Contactheader;
use App\Nav;
use App\Logo;




class PriceController extends Controller
{
    public function price(){
      $prices = Price::all();
      $requestqs = Requestq::all();
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      return view('pages.price',compact('prices','requestqs','contactheaders','navs','logos'));
    }
}
