<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    // the comments method will call in the postDetail view to show all comments post
    function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }
    // all post is belong to only one user
    function user(){
        return $this->BelongsTo(User::class);
    }
}
