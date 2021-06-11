<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;
    protected $table = 'comment_replies';
    protected $fillable = [
        'comment_id', 'user_id', 'comment_reply'
    ];
    
    function comment(){
        return $this->BelongsTo(Comment::class)->orderBy('created_at','DESC');
    }
    function user(){
        return $this->BelongsTo(User::class);
    }
}
