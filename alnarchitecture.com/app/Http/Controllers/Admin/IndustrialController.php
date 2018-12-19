<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Industrial;
use Carbon\Carbon;

class IndustrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industrials = Industrial::all();
        return view('admin.industrial.index',compact('industrials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.industrial.create');
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
     if (!file_exists('images/industrial'))
     {
         mkdir('images/industrial', 0777 , true);
     }
     $image->move('images/industrial',$imagename);
 }else {
     $imagename = 'default.png';
 }

 $industrial = new Industrial();
 $industrial->image = $imagename;
 $industrial->save();
 return redirect()->route('industrial.index')->with('successMsg','Industrial building Successfully saved');

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
        $industrial = Industrial::find($id);
        return view('admin.industrial.edit',compact('industrial'));

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
        $industrial = Industrial::find($id);
        if (isset($image))
        {
             $currentDate = Carbon::now()->toDateString();
             $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
             if (!file_exists('images/industrial'))
             {
                 mkdir('images/industrial', 0777 , true);
             }
             $image->move('images/industrial',$imagename);
        }else {
             $imagename = $industrial->image;
        }


        $industrial->image = $imagename;
        $industrial->save();
        return redirect()->route('industrial.index')->with('successMsg','Industrial Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $industrial = Industrial::find($id);
        if (file_exists('images/industrial/'.$industrial->image))
        {
         unlink('images/industrial/'.$industrial->image);
    }
      $industrial->delete();
      return redirect()->back()->with('successMsg','Industrial Successfully Deleted');

    }
}
