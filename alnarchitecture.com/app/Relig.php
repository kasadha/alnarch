<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relig extends Model
{
  public function slider(){
     return $this->hasMany(Slider::class);
 }
}
