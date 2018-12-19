<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blogheader;
use Carbon\Carbon;

class BlogheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogheaders = Blogheader::all();
        return view('admin.blog.header.index',compact('blogheaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.header.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

         'image' => 'required|mimes:jpeg,jpg,bmp,png',
     ]);
     $image = $request->file('image');
     $slug = str_slug($request->btn_url);
     if (isset($image))
     {
         $currentDate = Carbon::now()->toDateString();
         $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
         if (!file_exists('images/blogheader'))
         {
             mkdir('images/blogheader', 0777 , true);
         }
         $image->move('images/blogheader',$imagename);
     }else {
         $imagename = 'default.png';
     }

     $blogheader = new Blogheader();
     $blogheader->image = $imagename;
     $blogheader->save();
     return redirect()->route('blogheader.index')->with('successMsg','Blogheader Successfully saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogheader = Blogheader::find($id);
        return view('admin.blog.header.edit',compact('blogheader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
          'image' => 'mimes:jpeg,jpg,bmp,png',
      ]);
      $image = $request->file('image');
      $slug = str_slug($request->btn_url);
      $blogheader = Blogheader::find($id);
      if (isset($image))
      {
          $currentDate = Carbon::now()->toDateString();
          $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
          if (!file_exists('images/blogheader'))
          {
              mkdir('images/blogheader', 0777 , true);
          }
          $image->move('images/blogheader',$imagename);
      }else {
          $imagename = $blogheader->image;
      }


      $blogheader->image = $imagename;
      $blogheader->save();
      return redirect()->route('blogheader.index')->with('successMsg','Aboutheader Successfully Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
