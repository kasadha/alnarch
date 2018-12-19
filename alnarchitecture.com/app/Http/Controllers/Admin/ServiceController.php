<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
                'service' => 'required',
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
                if (!file_exists('images/service'))
                {
                    mkdir('images/service', 0777 , true);
                }
                $image->move('images/service',$imagename);
            }else {
                $imagename = 'default.png';
            }

            $service = new Service();
            $service->service = $request->service;
            $service->description = $request->description;
            $service->btn_url = $request->btn_url;

            $service->image = $imagename;
            $service->save();
            return redirect()->route('service.index')->with('successMsg','Service Successfully saved');
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
        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
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
            'service' => 'required',
            'description' => 'required',
            'btn_url' => 'required',

            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->service);
        $service = Service::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/service'))
            {
                mkdir('images/service', 0777 , true);
            }
            $image->move('images/service',$imagename);
        }else {
            $imagename = $service->image;
        }

        $service->service = $request->service;
        $service->btn_url = $request->btn_url;
        $service->description = $request->description;
        $service->image = $imagename;
        $service->save();
        return redirect()->route('service.index')->with('successMsg','Service Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (file_exists('images/service/'.$service->image))
        {
            unlink('images/service/'.$service->image);
        }
        $service->delete();
        return redirect()->back()->with('successMsg','Service Successfully Deleted');
    }
}
