<?php

namespace App;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use Searchable;

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function internships()
    {
        return $this->belongsToMany('App\Internship');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function recommendations()
    {
        return $this->hasMany('App\Recommendation');
    }

    public function searchableAs()
    {
        return 'students_index';
    }
    

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function getScoutKey()
    {
        return $this->id;
    }

}
