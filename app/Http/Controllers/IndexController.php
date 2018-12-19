<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Explore;
use App\Service;
use App\Client;
use App\Price;
use App\Homeportfolio;
use App\Requestq;
use App\Contactheader;
use App\Nav;
use App\Logo;
use App\Civic;
use App\Commercial;

class IndexController extends Controller
{
    public function index(){
      $sliders = Slider::all();
      $explores = Explore::all();
      $services = Service::all();
      $clients = Client::all();
      $prices = Price::all();
      $requestqs = Requestq::all();
      $homeportfolios = Homeportfolio::all();
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();

      return view('index',compact('sliders','explores',
                                  'services','clients',
                                  'prices','homeportfolios',
                                  'requestqs',
                                  'contactheaders',
                                  'navs',
                                  'logos'

                                ));
    }

    public function category($id){
    $sliders = Slider::all();
      $slider = Slider::findOrFail($id);
      $explores = Explore::all();
      $services = Service::all();
      $clients = Client::all();
      $prices = Price::all();
      $requestqs = Requestq::all();
      $homeportfolios = Homeportfolio::all();
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
       $civics = Civic::all();
       $commercials = Commercial::all();
      return view('pages.detail',compact('slider',
      'services','clients',
      'prices','homeportfolios',
      'requestqs',
      'contactheaders',
      'navs',
      'logos',
      'explores',
      'sliders',
      'civics',
      'commercials'

                                        ));
    }
}
