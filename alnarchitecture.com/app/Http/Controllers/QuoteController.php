<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;


class QuoteController extends Controller
{
  public function quote(Request $request){
      $this->validate($request,[
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required',
          'message' => 'required'
      ]);
      $quote = new Quote();
      $quote->name = $request->name;
      $quote->phone = $request->phone;
      $quote->email = $request->email;
      $quote->message = $request->message;
      $quote->save();

      return redirect()->route('index')->with('successMsg',' Your Request has been successfully Sent');
  }
}
