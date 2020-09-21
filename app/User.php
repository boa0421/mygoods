<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password','nickname', 'profile', 'hobby', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $guarded = array('id');
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function followings()
    {
        return $this->belongsToMany('App\User', 'user_follow', 'user_id', 'following_user_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany('App\User', 'user_follow', 'following_user_id', 'user_id')->withTimestamps();
    }
    
    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes', 'user_id', 'post_id')->withTimestamps();
    }

    
     public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    public function is_following($userId)
    {
        return $this->followings()->where('following_user_id', $userId)->exists();
    }
    
    
    public function like($postId)
    {
        $exist = $this->is_like($postId);
        
        if($exist){
            return false;
        }else{
            $this->likes()->attach($postId);
            return true;
        }
    }

    public function unlike($postId)
    {
        $exist = $this->is_like($postId);
        
        if($exist){
            $this->likes()->detach($postId);
            return true;
        }else{
            return false;
        }
    }

    public function is_like($postId)
    {
        return $this->likes()->where('post_id',$postId)->exists();
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function interests()
    {
        return $this->belongsToMany('App\Interest', 'interest_user', 'user_id', 'interest_id')->withTimestamps();
    }
}
