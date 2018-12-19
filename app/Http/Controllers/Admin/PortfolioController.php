<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolio;
use Carbon\Carbon;
use App\Service;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolio.index',compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.portfolio.create',compact('services'));
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
            if (!file_exists('images/portfolio'))
            {
                mkdir('images/portfolio', 0777 , true);
            }
            $image->move('images/portfolio',$imagename);
        }else {
            $imagename = 'default.png';
        }

        $portfolio = new Portfolio();
        $portfolio->services_id = $request->services;
        $portfolio->description = $request->description;
        $portfolio->btn_url = $request->btn_url;
        $portfolio->image = $imagename;
        $portfolio->save();
        return redirect()->route('portfolio.index')->with('successMsg','Portfolio Successfully saved');

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
        $portfolio = Portfolio::find($id);
      $services = Service::all();
      return view('admin.portfolio.edit',compact('portfolio','services'));

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
        $portfolio = Portfolio::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/portfolio'))
            {
                mkdir('images/portfolio', 0777 , true);
            }
            $image->move('images/portfolio',$imagename);
        }else {
            $imagename = $portfolio->image;
        }

        $portfolio->services_id = $request->services;
        $portfolio->btn_url = $request->btn_url;
        $portfolio->description = $request->description;
        $portfolio->image = $imagename;
        $portfolio->save();
        return redirect()->route('portfolio.index')->with('successMsg','portfolio Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        if (file_exists('images/portfolio/'.$portfolio->image))
        {
            unlink('images/portfolio/'.$portfolio->image);
        }
        $portfolio->delete();
        return redirect()->back()->with('successMsg','Portfolio Successfully Deleted');

    }
}
