<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    //


    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
