<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Comment extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'post_id' => 'required',
        'user_id' => 'required',
        'comment' => 'required',
    );

    public function post()
    {
         return $this->belongsTo('App\Post');
    }

    public function user()
    {
         return $this->belongsTo('App\User');
    }
}
