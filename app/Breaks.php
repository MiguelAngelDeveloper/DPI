<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Windows;

class Breaks extends Model
{
    //
   public function ad()
  {
      return $this->belongsTo('App\Ads');
  }
}
