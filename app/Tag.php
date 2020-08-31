<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'tag_name' => 'required',
    );
    
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_tag')->withTimestamps();
    }
    
}