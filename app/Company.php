<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Company extends Model
{
    use Searchable;

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function recommendations()
    {
        return $this->hasMany('App\Recommendation');
    }


    //funkcija koja proverava da li je student bio na praksi u datoj kompaniji

    public function checkIfStudentBelongsToCompanyInternship(Student $student)
    {
        $internshipsCompany = $this->internships;
        $internshipsStudent = $student->internships;


        $contains = array();
        foreach($internshipsCompany as $iComp)
            $contains = array_has($internshipsStudent, $iComp);

        if (!$contains)
            return true;
        else
            return false;

      //  $c = array_intersect($internshipsCompany, $internshipsStudent);
      //  if (count($c) > 0) {
      //      return true;
      //  }
      //  else
      //      return false;
    }

    public function  checkIfCompanyBelongsToStudentRecommendations(Student $student)
    {
        $check = false;
        $studentRecommendations = $student->recommendations;
        foreach ($studentRecommendations as $recommendation)
        {
            if($recommendation->company->id == $this->id)
                $check = true;
        }
        return $check;
    }

    // Scout functions

    public function searchableAs()
    {
        return 'companies_index';
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
