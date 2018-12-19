<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commercial;
use Carbon\Carbon;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commercials = Commercial::all();
        return view('admin.commercial.index',compact('commercials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.commercial.create');
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
       if (!file_exists('images/commercial'))
       {
           mkdir('images/commercial', 0777 , true);
       }
       $image->move('images/commercial',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $commercial = new Commercial();
   $commercial->image = $imagename;
   $commercial->save();
   return redirect()->route('commercial.index')->with('successMsg','Commercial building Successfully saved');

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
      $commercial = Commercial::find($id);
      return view('admin.commercial.edit',compact('commercial'));

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
      $commercial = Commercial::find($id);
      if (isset($image))
      {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/commercial'))
           {
               mkdir('images/commercial', 0777 , true);
           }
           $image->move('images/commercial',$imagename);
      }else {
           $imagename = $commercial->image;
      }


      $commercial->image = $imagename;
      $commercial->save();
      return redirect()->route('commercial.index')->with('successMsg','Commercial Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $commercial = Commercial::find($id);
      if (file_exists('images/commercial/'.$commercial->image))
      {
       unlink('images/commercial/'.$commercial->image);
  }
    $commercial->delete();
    return redirect()->back()->with('successMsg','Commercial Successfully Deleted');

    }
}
