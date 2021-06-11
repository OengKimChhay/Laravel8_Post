<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class HomeController extends Controller
{
    // for all post and search post 
    function Home(Request $req){
        if($req->has('search')){
            $search = $req->search;
            $post = Post::where('title','like','%'.$search.'%')->
                          orwhere('tag','like','%'.$search.'%')->
                          orderBy('id','DESC')->paginate(5);
        }else{
            $post = Post::orderBy('id','DESC')->paginate(5);
        }
        return view('home',['post'=>$post]);
    }
    
    // for detail post
    function detail(Request $req,$id){
        Post::find($id)->increment('views');  //to increas view when click on post
        $post = Post::find($id);
        return view('postDetail',['detail'=>$post]);
    }
    
    // show all post with match category
    function allPostWithCat(Request $req,$slug,$catID){
        $allPostCat = Post::where('cat_id',$catID)->orderBy('id','DESC')->paginate(5);
        return view('allPostWithCat',['allPostCat'=>$allPostCat]);
    }
}
