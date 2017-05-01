<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'city', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function header()
    {
        return $this->hasOne('App\Header');
    }

    public function picture()
    {
        return $this->belongsToMany('App\Picture');
    }

    public function categories() {
        return $this->hasMany('App\Category');
    }

    public function parentcomments() {
        return $this->hasMany('App\Parentcomment');
    }
}
