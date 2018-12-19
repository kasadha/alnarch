<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Portfolioheader;
use App\Nav;
use App\Logo;
use App\Civic;
use App\Contactheader;

class PortfolioController extends Controller
{
    public function portfolio(){
      $portfolios = Portfolio::all();
      $portfolioheaders = Portfolioheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      $contactheaders = Contactheader::all();
      return view('pages.portfolio',compact('portfolios','contactheaders','navs','logos','portfolioheaders','contactheaders'));
    }

    public function detail($id){
      $portfolio = Portfolio::findOrFail($id);
      $portfolioheaders = Portfolioheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      $civics = Civic::all();
      $contactheaders = Contactheader::all();
      return view('pages.portfoliodetail',compact('portfolio','contactheaders','navs','logos','civics','portfolioheaders','contactheaders'));
    }
}
