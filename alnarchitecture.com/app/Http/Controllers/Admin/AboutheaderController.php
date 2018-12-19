<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aboutheader;
use Carbon\Carbon;

class AboutheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutheaders = Aboutheader::all();
        return view('admin.about.index',compact('aboutheaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
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
         if (!file_exists('images/about'))
         {
             mkdir('images/about', 0777 , true);
         }
         $image->move('images/about',$imagename);
     }else {
         $imagename = 'default.png';
     }

     $aboutheader = new Aboutheader();
     $aboutheader->image = $imagename;
     $aboutheader->save();
     return redirect()->route('aboutheader.index')->with('successMsg','Slider Successfully saved');
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
        $aboutheader = Aboutheader::find($id);
      return view('admin.about.edit',compact('aboutheader'));
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
        $aboutheader = Aboutheader::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/about'))
            {
                mkdir('images/about', 0777 , true);
            }
            $image->move('images/about',$imagename);
        }else {
            $imagename = $aboutheader->image;
        }


        $aboutheader->image = $imagename;
        $aboutheader->save();
        return redirect()->route('aboutheader.index')->with('successMsg','Aboutheader Successfully Updated');

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
