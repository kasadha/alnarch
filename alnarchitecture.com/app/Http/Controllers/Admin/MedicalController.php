<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medical;
use Carbon\Carbon;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicals = Medical::all();
        return view('admin.medical.index',compact('medicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medical.create');
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
       if (!file_exists('images/medical'))
       {
           mkdir('images/medical', 0777 , true);
       }
       $image->move('images/medical',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $medical = new Medical();
   $medical->image = $imagename;
   $medical->save();
   return redirect()->route('medical.index')->with('successMsg','Medical building Successfully saved');

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
      $medical = Medical::find($id);
      return view('admin.medical.edit',compact('medical'));

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
      $medical = Medical::find($id);
      if (isset($image))
      {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/medical'))
           {
                mkdir('images/medical', 0777 , true);
           }
           $image->move('images/medical',$imagename);
      }else {
           $imagename = $medical->image;
      }


      $medical->image = $imagename;
      $medical->save();
      return redirect()->route('medical.index')->with('successMsg','medical Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $medical = Medical::find($id);
      if (file_exists('images/medical/'.$medical->image))
      {
       unlink('images/medical/'.$medical->image);
  }
    $medical->delete();
    return redirect()->back()->with('successMsg','Medical Successfully Deleted');

    }
}
