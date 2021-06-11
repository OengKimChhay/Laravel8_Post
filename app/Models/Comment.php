<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    // user method will show the user name in comment section
    function user(){
        // the BelongsTo method try to match user_id in comment with id in user 
        return $this->BelongsTo(User::class);
    }
    function replies(){
        return $this->hasMany(CommentReply::class)->orderBy('id','desc');
    }
}
