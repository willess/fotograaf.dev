<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $primaryKey = 'user_id';


    protected $fillable = [
        'header', 'title', 'text'
    ];
}
