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
    
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
