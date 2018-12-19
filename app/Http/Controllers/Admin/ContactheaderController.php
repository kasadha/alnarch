<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contactheader;
use Carbon\Carbon;

class ContactheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactheaders = Contactheader::all();
        return view('admin.contact.index',compact('contactheaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.create');
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
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',
        'fb' => 'required',
        'instagram' => 'required',
        'twiter' => 'required',
       'image' => 'required|mimes:jpeg,jpg,bmp,png',
   ]);
   $image = $request->file('image');
   $slug = str_slug($request->btn_url);
   if (isset($image))
   {
       $currentDate = Carbon::now()->toDateString();
       $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
       if (!file_exists('images/contact'))
       {
           mkdir('images/contact', 0777 , true);
       }
       $image->move('images/contact',$imagename);
   }else {
       $imagename = 'default.png';
   }

   $contactheader = new Contactheader();
   $contactheader->phone = $request->phone;
   $contactheader->email = $request->email;
   $contactheader->address = $request->address;
   $contactheader->fb = $request->fb;
   $contactheader->twiter = $request->twiter;
   $contactheader->instagram = $request->instagram;
   $contactheader->image = $imagename;
   $contactheader->save();
   return redirect()->route('contactheader.index')->with('successMsg','Contactheader Successfully saved');

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
      $contactheader = Contactheader::find($id);
      return view('admin.contact.edit',compact('contactheader'));

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
         'phone' => 'required',
         'email' => 'required',
         'address' => 'required',
         'fb' => 'required',
        'instagram' => 'required',
        'twiter' => 'required',
       'image' => 'mimes:jpeg,jpg,bmp,png',
   ]);
   $image = $request->file('image');
   $slug = str_slug($request->btn_url);
   $contactheader = Contactheader::find($id);
   if (isset($image))
   {
       $currentDate = Carbon::now()->toDateString();
       $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
       if (!file_exists('images/contact'))
       {
            mkdir('images/contact', 0777 , true);
       }
       $image->move('images/contact',$imagename);
   }else {
       $imagename = $contactheader->image;
   }
   $contactheader->fb = $request->fb;
   $contactheader->twiter = $request->twiter;
   $contactheader->instagram = $request->instagram;
   $contactheader->phone = $request->phone;
   $contactheader->email = $request->email;
   $contactheader->address = $request->address;
   $contactheader->image = $imagename;
   $contactheader->save();
   return redirect()->route('contactheader.index')->with('successMsg','Contactheader Successfully Updated');

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
