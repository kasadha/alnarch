<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
  public function services(){
      return $this->belongsTo(Service::class);
  }
}
