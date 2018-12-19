<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
  public function slider(){
     return $this->hasMany(Slider::class);
 }
}
