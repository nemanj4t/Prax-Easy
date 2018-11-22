<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'type', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function faculty()
    {
        return $this->hasOne('App\Faculty');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function is_student()
    {
        if($this->type == 'student')
        {
            return true;
        }
        return false;
    }

    public function is_admin()
    {
        if($this->type == 'admin')
        {
            return true;
        }
        return false;
    }

    public function is_faculty()
    {
        if($this->type == 'faculty')
        {
            return true;
        }
        return false;
    }

    public function is_company()
    {
        if($this->type == 'company')
        {
            return true;
        }
        return false;
    }

    public function verified()
    {
        return $this->token === null;
    }

    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }

}

