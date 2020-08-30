<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    
    Public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
    Public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
