<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Team;
use Carbon\Carbon;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.team.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
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
            if (!file_exists('images/team'))
            {
                mkdir('images/team', 0777 , true);
            }
            $image->move('images/team',$imagename);
        }else {
            $imagename = 'default.png';
        }

        $team = new Team();
        $team->name = $request->name;
        $team->occupation = $request->occupation;
        $team->comment = $request->comment;
        $team->image = $imagename;
        $team->save();
        return redirect()->route('team.index')->with('successMsg','Team Successfully saved');

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
        $team = Team::find($id);
        return view('admin.team.edit',compact('team'));

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
      $team = Team::find($id);
      if (isset($image))
      {
          $currentDate = Carbon::now()->toDateString();
          $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
          if (!file_exists('images/team'))
          {
              mkdir('images/team', 0777 , true);
          }
          $image->move('images/team',$imagename);
      }else {
          $imagename = $team->image;
      }

      $team->name = $request->name;
      $team->comment = $request->comment;
      $team->occupation = $request->occupation;
      $team->image = $imagename;
      $team->save();
      return redirect()->route('team.index')->with('successMsg','Team Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
      if (file_exists('images/team/'.$team->image))
      {
          unlink('images/team/'.$team->image);
      }
      $team->delete();
      return redirect()->back()->with('successMsg','Team Successfully Deleted');

    }
}
