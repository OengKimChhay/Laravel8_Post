<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentController extends Controller
{
    // for save comments
    function saveComment(Request $req,$id){
        $validate = $req->validate([
            'comment'=>'required'
        ]);
        $com = new Comment;
        $com->user_id = $req->user()->id;
        $com->post_id = $id;
        $com->comment = $req->comment;
        $com->save();
        if($com){
            return redirect()->back()->with(['success'=>'comment added!']);
        }else{
            return redirect()->back()->with(['fail'=>'Can not add comment!']);
        }
    }

    function showCmm(){
        $com = Comment::orderBy('id','asc')->paginate(5);
        return view('admin.comment.index',['comment'=>$com]);
    }
    
    function deleteCom($id){
        $com = Comment::find($id);
        $com->delete();
        if($com){
            return back()->with(['success'=>'Delete Success!']);
        }else{
            return back()->with(['fail'=>'Can not delete this comment!']);
        }
    }
}
