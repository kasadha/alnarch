<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Education;
use Carbon\Carbon;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::all();
        return view('admin.education.index',compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.education.create');
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
     if (!file_exists('images/education'))
     {
         mkdir('images/education', 0777 , true);
     }
     $image->move('images/education',$imagename);
 }else {
     $imagename = 'default.png';
 }

 $education = new Education();
 $education->image = $imagename;
 $education->save();
 return redirect()->route('education.index')->with('successMsg','Education building Successfully saved');

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
        $education = Education::find($id);
        return view('admin.education.edit',compact('education'));

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
        $education = Education::find($id);
        if (isset($image))
        {
             $currentDate = Carbon::now()->toDateString();
             $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
             if (!file_exists('images/education'))
             {
                 mkdir('images/education', 0777 , true);
             }
             $image->move('images/education',$imagename);
        }else {
             $imagename = $education->image;
        }


        $education->image = $imagename;
        $education->save();
        return redirect()->route('education.index')->with('successMsg','Education Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $education = Education::find($id);
        if (file_exists('images/education/'.$education->image))
        {
         unlink('images/education/'.$education->image);
    }
      $education->delete();
      return redirect()->back()->with('successMsg','Education Successfully Deleted');


    }
}
