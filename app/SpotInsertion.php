<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Breaks;
use App\Ads;

class SpotInsertion extends Model
{
    //
     protected $table = 'spot_insertion';
     public function ad()
    {
        return $this->belongsTo('App\Ads');
    }
     public function break()
    {
        return $this->belongsTo('App\Breaks');
    }
    public function window()
   {
       return $this->belongsTo('App\Windows');
   }

}
