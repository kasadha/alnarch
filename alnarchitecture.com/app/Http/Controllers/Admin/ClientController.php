<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use Carbon\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
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
          'name' => 'required',
          'occupation' => 'required',
          'comment' => 'required',
          'image' => 'required|mimes:jpeg,jpg,bmp,png',
      ]);
      $image = $request->file('image');
      $slug = str_slug($request->name);
      if (isset($image))
      {
          $currentDate = Carbon::now()->toDateString();
          $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
          if (!file_exists('images/client'))
          {
              mkdir('images/client', 0777 , true);
          }
          $image->move('images/client',$imagename);
      }else {
          $imagename = 'default.png';
      }

      $client = new Client();
      $client->name = $request->name;
      $client->occupation = $request->occupation;
      $client->comment = $request->comment;
      $client->image = $imagename;
      $client->save();
      return redirect()->route('client.index')->with('successMsg','Client Successfully saved');
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
        $client = Client::find($id);
        return view('admin.client.edit',compact('client'));

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
            'name' => 'required',
            'occupation' => 'required',
            'comment' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $client = Client::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('images/client'))
            {
                mkdir('images/client', 0777 , true);
            }
            $image->move('images/client',$imagename);
        }else {
            $imagename = $client->image;
        }

        $client->name = $request->name;
        $client->comment = $request->comment;
        $client->occupation = $request->occupation;
        $client->image = $imagename;
        $client->save();
        return redirect()->route('client.index')->with('successMsg','Client Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (file_exists('images/client/'.$client->image))
        {
            unlink('images/client/'.$client->image);
        }
        $client->delete();
        return redirect()->back()->with('successMsg','Client Successfully Deleted');

    }
}
