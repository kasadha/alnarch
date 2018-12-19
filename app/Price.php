<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  public function services(){
      return $this->belongsTo(Service::class);
  }
}
