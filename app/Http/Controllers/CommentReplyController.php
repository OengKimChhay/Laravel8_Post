<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReply;
use Auth;

class CommentReplyController extends Controller
{
    function saveCommentReply(Request $req,$com_id){
        $validate = $req->validate([
            'replyCom'=>'required|max:100',
        ]);
        
        $comReply = New CommentReply;
        $comReply->comment_id = $com_id;
        $comReply->comment_reply = $req->replyCom;
        $comReply->user_id = $req->user()->id;
        $comReply->save();
        if($comReply){
            return redirect()->back()->with(['successReply'=>'comment repy!']);
        }else{
            return redirect()->back()->with(['failReply'=>'Can not reply this comment!']);
        }
    }
}
