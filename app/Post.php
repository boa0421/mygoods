<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'image' => 'required',
    );
    
    Public function user()
    {
        return $this->belongsTo('App\User');
    }
}
