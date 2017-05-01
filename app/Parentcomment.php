<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentcomment extends Model
{

    protected $fillable = [
        'reaction', 'username'
    ];

}
