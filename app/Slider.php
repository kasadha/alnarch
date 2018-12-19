<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  public function categories(){
      return $this->belongsTo(Category::class);
  }
  public function agric(){
    return $this->belongsTo(Agric::class);
  }
  public function civic(){
    return $this->belongsTo(Civic::class);
  }
  public function commercial(){
    return $this->belongsTo(Commercial::class);
  }
  public function education(){
    return $this->belongsTo(Education::class);
  }
  public function industrial(){
    return $this->belongsTo(Industrial::class);
  }
  public function medical(){
    return $this->belongsTo(Medical::class);
  }
  public function relig(){
    return $this->belongsTo(Relig::class);
  }
}
