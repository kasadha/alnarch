<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
  public function slider(){
     return $this->hasMany(Slider::class);
 }
}
