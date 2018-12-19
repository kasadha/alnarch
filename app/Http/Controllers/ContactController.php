<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Contactheader;
use App\Nav;
use App\Logo;

class ContactController extends Controller
{
    public function contact(){
      $contactheaders = Contactheader::all();
      $navs = Nav::all();
      $logos = Logo::all();
      return view('pages.contact_us',compact('contactheaders','navs','logos'));
    }

    public function message(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ]);
        $message = new Message();
        $message->name = $request->name;
        $message->phone = $request->phone;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->save();

        return redirect()->route('contact_us')->with('successMsg',' Successfully Sent');
    }
}
