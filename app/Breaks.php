<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channels;
class Breaks extends Model
{
    //
    public function channel()
   {
       return $this->belongsTo('App\Channels');
   }
}
