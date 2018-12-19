<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  public function price(){
     return $this->hasMany(Price::class);
   }
   public function portfolios(){
      return $this->hasMany(Portfolio::class);
    }
    public function homeportfolios(){
       return $this->hasMany(Homeportfolio::class);
     }
}
