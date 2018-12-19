<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Civic;
use Carbon\Carbon;

class CivicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $civics = Civic::all();
        return view('admin.civic.index',compact('civics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.civic.create');
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
       if (!file_exists('images/civic'))
       {
           mkdir('images/civic', 0777 , true);
       }
       $image->move('images/civic',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $civic = new Civic();
   $civic->image = $imagename;
   $civic->save();
   return redirect()->route('civic.index')->with('successMsg','Civic building Successfully saved');

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
      $civic = Civic::find($id);
      return view('admin.civic.edit',compact('civic'));
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
      $civic = Civic::find($id);
      if (isset($image))
      {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/civic'))
           {
                mkdir('images/civic', 0777 , true);
           }
           $image->move('images/civic',$imagename);
      }else {
           $imagename = $civic->image;
      }


      $civic->image = $imagename;
      $civic->save();
      return redirect()->route('civic.index')->with('successMsg','Civic Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $civic = Civic::find($id);
      if (file_exists('images/civic/'.$civic->image))
      {
       unlink('images/civic/'.$civic->image);
  }
    $civic->delete();
    return redirect()->back()->with('successMsg','Civic Successfully Deleted');

    }
}
