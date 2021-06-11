<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    
    // show all users
    function allUser(){
        $user = User::orderBy('id','asc')->paginate(5);
        return view('admin.user.showUser',['data'=>$user]);
    }

    // delete user by admin
    function deleteUser($userId){
        $user = User::find($userId);
        $user->delete();
        if($user){
            // this mean that when admin delete someone user all posts who user own are also delete
            $post = Post::where('user_id',$userId);
            $post->delete();
            return back()->with(['success'=>'Delete Success']);
        }else{
            return back()->with(['fail'=>'Can not delete this user!']);
        }
    }
    
    function addPost(){
      $cat = Category::all();
       return view('user.addPost',['data'=>$cat]);
    }

    function savePost(Request $request){
        $validate = $request->validate([
            'category'=>'required',
            'title' => 'required',
            'detail'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'required'
        ]);
        // check file
        if($request->hasFile('image')){
            $imageName = null;
            $image = $request->file('image');
            $desitate_path = 'images/postImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }

        $post = new Post;
        $post->user_id = auth()->user()->id; 
        $post->cat_id = $request->category;
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tag = $request->tag;
        $post->full_img = $imageName;
        $post->views = 0; //means that the first post has 0 viewer
        $post->save();
        if($post){
            return back()->with(['success'=>'Add post success!']);
        }else{
            return back()->with(['fail'=>'Can not Add post !']);
        }
    }

}
