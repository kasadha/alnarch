<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo;
use Carbon\Carbon;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::all();
        return view('admin.logo.index',compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logo.create');
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
       if (!file_exists('images/logo'))
       {
           mkdir('images/logo', 0777 , true);
       }
       $image->move('images/logo',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $logo = new Logo();
   $logo->image = $imagename;
   $logo->save();
   return redirect()->route('nav.index')->with('successMsg','Logo Successfully saved');

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
      $logo = Logo::find($id);
 return view('admin.logo.edit',compact('logo'));

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
   $logo = Logo::find($id);
   if (isset($image))
   {
      $currentDate = Carbon::now()->toDateString();
      $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
      if (!file_exists('images/logo'))
      {
           mkdir('images/logo', 0777 , true);
      }
      $image->move('images/logo',$imagename);
   }else {
      $imagename = $nav->image;
   }


   $logo->image = $imagename;
   $logo->save();
   return redirect()->route('logo.index')->with('successMsg','logo Successfully Updated');

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
