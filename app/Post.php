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
    
    public function like_users()
    {
        return $this->belongsToMany('App\User','likes','post_id','user_id')->withTimestamps();
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
