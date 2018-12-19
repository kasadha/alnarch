<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolioheader;
use Carbon\Carbon;

class PortfolioheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $portfolioheaders = Portfolioheader::all();
      return view('admin.portfolioheader.index',compact('portfolioheaders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.portfolioheader.create');
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
       if (!file_exists('images/portfolio'))
       {
           mkdir('images/portfolio', 0777 , true);
       }
       $image->move('images/portfolio',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $portfolioheader = new Portfolioheader();
   $portfolioheader->image = $imagename;
   $portfolioheader->save();
   return redirect()->route('portfolioheader.index')->with('successMsg','Slider Successfully saved');

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
      $portfolioheader = Portfolioheader::find($id);
    return view('admin.portfolioheader.edit',compact('portfolioheader'));

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
      $portfolioheader = Portfolioheader::find($id);
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
          $imagename = $portfolioheader->image;
      }


      $portfolioheader->image = $imagename;
      $portfolioheader->save();
      return redirect()->route('portfolioheader.index')->with('successMsg','Portfolioheader Successfully Updated');

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
