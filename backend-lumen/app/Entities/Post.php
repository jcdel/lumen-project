<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','text','image','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}