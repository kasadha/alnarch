<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeportfolio extends Model
{
  public function services(){
      return $this->belongsTo(Service::class);
  }
}
