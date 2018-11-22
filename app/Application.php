<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Application extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function internship()
    {
        return $this->belongsTo('App\Internship');
    }
}
