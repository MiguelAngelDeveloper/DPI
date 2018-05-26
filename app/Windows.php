<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channels;
class Windows extends Model
{
    //
    public function channel()
   {
       return $this->belongsTo('App\Channels');
   }
}
