<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Windows;

class Breaks extends Model
{
    //
    public function window()
   {
       return $this->belongsTo('App\Windows');
   }
}
