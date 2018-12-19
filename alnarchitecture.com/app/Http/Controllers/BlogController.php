<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Blogheader;
use App\Contactheader;
use App\Nav;
use App\Logo;


class BlogController extends Controller
{
    public function index(){
      $blogs = Blog::all();
      $blogheaders = Blogheader::all();
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      return view('blog.index',compact('blogs','blogheaders','contactheaders','navs','logos'));
    }
    public function show($id){
        $blog = Blog::findOrFail($id);
        $blogheaders = Blogheader::all();
        $contactheaders = Contactheader::all();
        $navs = Nav::all();
        $logos = Logo::all();
        return view('blog.single',compact('blog','blogheaders','contactheaders','navs','logos'));
    }
}
