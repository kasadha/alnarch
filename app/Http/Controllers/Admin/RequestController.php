<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Requestq;
use Carbon\Carbon;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestqs = Requestq::all();
        return view('admin.requestq.index',compact('requestqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.requestq.create');
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
           'title' => 'required',
           'btn_title' => 'required',
           'image' => 'required|mimes:jpeg,jpg,bmp,png',
       ]);
       $image = $request->file('image');
       $slug = str_slug($request->title);
       if (isset($image))
       {
           $currentDate = Carbon::now()->toDateString();
           $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
           if (!file_exists('images/requestq'))
           {
               mkdir('images/requestq', 0777 , true);
           }
           $image->move('images/requestq',$imagename);
       }else {
           $imagename = 'default.png';
       }

       $requestq = new Requestq();
       $requestq->title = $request->title;
       $requestq->btn_title = $request->btn_title;
       $requestq->image = $imagename;
       $requestq->save();
       return redirect()->route('requestq.index')->with('successMsg','Requestq Successfully saved');

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
        $requestq = Requestq::find($id);
      return view('admin.requestq.edit',compact('requestq'));

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
            'title' => 'required',
            'btn_title' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $requestq = Requestq::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/requestq'))
            {
                mkdir('images/requestq', 0777 , true);
            }
            $image->move('images/requestq',$imagename);
        }else {
            $imagename = $requestq->image;
        }

        $requestq->title = $request->title;
        $requestq->btn_title = $request->btn_title;
        $requestq->image = $imagename;
        $requestq->save();
        return redirect()->route('requestq.index')->with('successMsg','Requestq Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requestq = Requestq::find($id);
        if (file_exists('images/homeportfolio/'.$requestq->image))
        {
            unlink('images/homeportfolio/'.$requestq->image);
        }
        $requestq->delete();
        return redirect()->back()->with('successMsg','requestq Successfully Deleted');

    }
}
