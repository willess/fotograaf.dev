<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

//    protected $dateFormat = 'd-m-Y';


    protected $fillable = [
        'image', 'title', 'location', 'subscription'
    ];

    public function category() {
        return $this->belongsToMany('App\Category');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function thumbnail()
    {
        return $this->hasOne('App\Thumbnail');
    }

    public function parentcomments() {
        return $this->hasMany('App\Parentcomment');
    }
}
