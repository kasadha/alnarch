<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Explore;
use Carbon\Carbon;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $explores = Explore::all();
        return view('admin.explore.index',compact('explores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.explore.create');
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
           'btn_url' => 'required',
           'image' => 'required|mimes:jpeg,jpg,bmp,png',
       ]);
       $image = $request->file('image');
       $slug = str_slug($request->btn_url);
       if (isset($image))
       {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/explore'))
           {
               mkdir('images/explore', 0777 , true);
           }
           $image->move('images/explore',$imagename);
       }else {
           $imagename = 'default.png';
       }

       $explore = new Explore();
       $explore->btn_url = $request->btn_url;
       $explore->image = $imagename;
       $explore->save();
       return redirect()->route('explore.index')->with('successMsg','Slider Successfully saved');
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
        $explore = Explore::find($id);
        return view('admin.explore.edit',compact('explore'));
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
            'btn_url' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->btn_url);
        $explore = Explore::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/explore'))
            {
                mkdir('images/explore', 0777 , true);
            }
            $image->move('images/explore',$imagename);
        }else {
            $imagename = $explore->image;
        }

        $explore->btn_url = $request->btn_url;
        $explore->image = $imagename;
        $explore->save();
        return redirect()->route('explore.index')->with('successMsg','Explore Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $explore = Explore::find($id);
      if (file_exists('images/explore/'.$explore->image))
      {
          unlink('images/explore/'.$explore->image);
      }
      $explore->delete();
      return redirect()->back()->with('successMsg','explore Successfully Deleted');

    }
}
