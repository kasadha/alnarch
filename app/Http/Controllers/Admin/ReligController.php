<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Relig;
use Carbon\Carbon;

class ReligController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $religs = Relig::all();
        return view('admin.relig.index',compact('religs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.relig.create');
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
     if (!file_exists('images/relig'))
     {
         mkdir('images/relig', 0777 , true);
     }
     $image->move('images/relig',$imagename);
 }else {
     $imagename = 'default.png';
 }

 $relig = new Relig();
 $relig->image = $imagename;
 $relig->save();
 return redirect()->route('relig.index')->with('successMsg','relig building Successfully saved');

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
      $relig = Relig::find($id);
      return view('admin.relig.edit',compact('relig'));

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
      $relig = Relig::find($id);
      if (isset($image))
      {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/relig'))
           {
               mkdir('images/relig', 0777 , true);
           }
           $image->move('images/relig',$imagename);
      }else {
           $imagename = $relig->image;
      }


      $relig->image = $imagename;
      $relig->save();
      return redirect()->route('relig.index')->with('successMsg','Religious Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relig = Relig::find($id);
        if (file_exists('images/relig/'.$relig->image))
        {
         unlink('images/relig/'.$relig->image);
    }
      $relig->delete();
      return redirect()->back()->with('successMsg','Religious Successfully Deleted');

    }
}
