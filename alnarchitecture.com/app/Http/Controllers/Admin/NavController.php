<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nav;
use Carbon\Carbon;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navs = Nav::all();
        return view('admin.nav.index',compact('navs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nav.create');
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
         if (!file_exists('images/nav'))
         {
             mkdir('images/nav', 0777 , true);
         }
         $image->move('images/nav',$imagename);
     }else {
         $imagename = 'default.png';
     }

     $nav = new Nav();
     $nav->image = $imagename;
     $nav->save();
     return redirect()->route('nav.index')->with('successMsg','Slider Successfully saved');

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
        $nav = Nav::find($id);
    return view('admin.nav.edit',compact('nav'));

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
    $nav = Nav::find($id);
    if (isset($image))
    {
        $currentDate = Carbon::now()->toDateString();
        $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
        if (!file_exists('images/nav'))
        {
            mkdir('images/nav', 0777 , true);
        }
        $image->move('images/nav',$imagename);
    }else {
        $imagename = $nav->image;
    }


    $nav->image = $imagename;
    $nav->save();
    return redirect()->route('nav.index')->with('successMsg','Nav Successfully Updated');

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
