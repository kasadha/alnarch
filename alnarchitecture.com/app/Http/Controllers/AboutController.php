<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Team;
use App\Requestq;
use App\Aboutheader;
use App\Contactheader;
use App\Nav;
use App\Logo;

class AboutController extends Controller
{
    public function about(){
      $clients = Client::all();
      $teams = Team::all();
      $requestqs = Requestq::all();
      $aboutheaders = Aboutheader::all();
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      return view('pages.about_us',compact('clients',
                                          'teams',
                                          'requestqs',
                                          'aboutheaders',
                                          'contactheaders',
                                          'navs',
                                          'logos'
                                        ));
    }
}
