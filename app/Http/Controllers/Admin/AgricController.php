<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agric;
use Carbon\Carbon;

class AgricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agrics = Agric::all();
        return view('admin.agric.index',compact('agrics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agric.create');
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
     if (!file_exists('images/agric'))
     {
         mkdir('images/agric', 0777 , true);
     }
     $image->move('images/agric',$imagename);
 }else {
     $imagename = 'default.png';
 }

 $agric = new Agric();
 $agric->image = $imagename;
 $agric->save();
 return redirect()->route('agric.index')->with('successMsg','Agric building Successfully saved');

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
        $agric = Agric::find($id);
        return view('admin.agric.edit',compact('agric'));

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
        $agric = Agric::find($id);
        if (isset($image))
        {
             $currentDate = Carbon::now()->toDateString();
             $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
             if (!file_exists('images/agric'))
             {
                 mkdir('images/agric', 0777 , true);
             }
             $image->move('images/agric',$imagename);
        }else {
             $imagename = $agric->image;
        }


        $agric->image = $imagename;
        $agric->save();
        return redirect()->route('agric.index')->with('successMsg','Agric Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agric = Agric::find($id);
        if (file_exists('images/agric/'.$agric->image))
        {
         unlink('images/agric/'.$agric->image);
    }
      $agric->delete();
      return redirect()->back()->with('successMsg','Agric Successfully Deleted');

    }
}
