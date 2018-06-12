<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Breaks;
use App\Ads;

class SpotInsertion extends Model
{
    //
     protected $table = 'spot_insertion';
     public function break()
    {
        return $this->belongsTo('App\Breaks');
    }
    public function ad()
   {
       return $this->belongsTo('App\Ads');
   }
}
