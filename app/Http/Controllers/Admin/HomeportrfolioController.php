<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Homeportfolio;
use App\Service;
use Carbon\Carbon;

class HomeportrfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $homeportfolios = Homeportfolio::all();
      return view('admin.homeportfolio.index',compact('homeportfolios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $services = Service::all();
      return view('admin.homeportfolio.create',compact('services'));

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
            'services' => 'required',
            'description' => 'required',
            'btn_url' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->service);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/homeportfolio'))
            {
                mkdir('images/homeportfolio', 0777 , true);
            }
            $image->move('images/homeportfolio',$imagename);
        }else {
            $imagename = 'default.png';
        }

        $homeportfolio = new Homeportfolio();
        $homeportfolio->services_id = $request->services;
        $homeportfolio->description = $request->description;
        $homeportfolio->btn_url = $request->btn_url;
        $homeportfolio->image = $imagename;
        $homeportfolio->save();
        return redirect()->route('homeportfolio.index')->with('successMsg','Homeportfolio Successfully saved');

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
        $homeportfolio = Homeportfolio::find($id);
      $services = Service::all();
      return view('admin.homeportfolio.edit',compact('homeportfolio','services'));

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
            'services' => 'required',
            'description' => 'required',
            'btn_url' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->services);
        $homeportfolio = Homeportfolio::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/homeportfolio'))
            {
                mkdir('images/homeportfolio', 0777 , true);
            }
            $image->move('images/homeportfolio',$imagename);
        }else {
            $imagename = $homeportfolio->image;
        }

        $homeportfolio->services_id = $request->services;
        $homeportfolio->btn_url = $request->btn_url;
        $homeportfolio->description = $request->description;
        $homeportfolio->image = $imagename;
        $homeportfolio->save();
        return redirect()->route('homeportfolio.index')->with('successMsg','homeportfolio Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homeportfolio = Homeportfolio::find($id);
        if (file_exists('images/homeportfolio/'.$homeportfolio->image))
        {
            unlink('images/homeportfolio/'.$homeportfolio->image);
        }
        $homeportfolio->delete();
        return redirect()->back()->with('successMsg','Homeportfolio Successfully Deleted');

    }
}
