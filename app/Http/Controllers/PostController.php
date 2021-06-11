<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $adminPost = Post::where('user_id','0')->paginate(5);
        $userPost = Post::where('user_id','>','0')->paginate(5); // this mean that inorder to match post user_id with user id ( the user() is in post controller)
        $cat = Category::all();
        return view('admin.post.index',['cat'=>$cat,'adminPost'=>$adminPost,'userPost'=>$userPost]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::all();
        return view('admin.post.create',['data'=>$cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $post->user_id = 0; //user_id =0 means that the poster is an admin not user
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::find($id);
        $cat = Category::all();
        return view('admin.post.show',['data'=>$data],['cat'=>$cat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        $cat = Category::all();
        return view('admin.post.edit',['data'=>$data],['cat'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'category'=>'required',
            'title' => 'required',
            'detail'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'required'
        ]);
        // check file
        $post = Post::find($id);
        if($request->hasFile('image')){
            // to delete old image before update
            $image_path = public_path("\images\postImg\\").$post->full_img;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $image = $request->file('image');
            $desitate_path = 'images/postImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }else{
            $imageName = $post->full_img;
        }

        $post->user_id = 0;
        $post->cat_id = $request->category;
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tag = $request->tag;
        $post->full_img = $imageName;
        $post->save();
        if($post){
            return back()->with(['success'=>'Edit post success!']);
        }else{
            return back()->with(['fail'=>'Can not edit post !']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id',$id)->first();
        $path = public_path("\images\postImg\\").$post->full_img;
        if(File::exists($path)){
            File::delete($path);
        }
        $post->delete();
        if($post){
            return Redirect()->back()->with(['success'=>'A category has been deleted!']);
        }else{
            return Redirect()->back()->with(['fail'=>'Can not delete!']);
        }

    }
    
}
