<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function internships()
    {
        return $this->belongsToMany('App\Internship');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

}
