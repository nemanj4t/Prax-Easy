<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Application;
use Laravel\Scout\Searchable;
use Carbon\Carbon;


class Internship extends Model
{
    use Searchable;

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }

    public function nijeAplicirano(Student $student)
    {
        $applications = Application::where('internship_id', $this->id)->get();
        foreach ($applications as $application)
        {
            if($application->student_id == $student->id)
            {
                return false;
            }
        }
        return true;
    }


    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


    // Scout functions

    public function searchableAs()
    {
        return 'internships_index';
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
    public function vecUpisana(Student $student)
    {
        foreach ($student->internships as $internship)
        {
            if($internship->id == $this->id)
            {
                return true;
            }
        }
        return false;
    }
    public function dodaj()
    {
        $this->current_number++;
        $this->save();
    }

    public function isActive()
    {
        if ($this->end > Carbon::now())
        {
            return true;
        }
        return false;
    }

    public function imaMesta()
    {
        if ($this->current_number < $this->maximum_number)
        {
            return true;
        }
        return false;
    }
}
