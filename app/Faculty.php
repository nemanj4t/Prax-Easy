<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }
}
