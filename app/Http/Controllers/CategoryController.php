<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::orderBy('id','asc')->paginate(5);
        return view('admin.category.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'title' => 'required',
            'detail'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // check file
        if($request->hasFile('image')){
            $imageName = null;
            $image = $request->file('image');
            $desitate_path = 'images/categoryImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }

        $save = new Category;
        $save->title = $request->title;
        $save->detail = $request->detail;
        $save->image = $imageName;
        $save->save();
        if($save){
            return back()->with(['success'=>'A category has been added!']);
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
        $data = Category::find($id);
        return view('admin.category.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin.category.edit',['data'=>$data]);
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
            'title' => 'required',
            'detail'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // check file
        $data = Category::find($id);
        if($request->hasFile('image')){
            // to delete old image before update
            $image_path = public_path("\images\categoryImg\\").$data->image;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $image = $request->file('image');
            $desitate_path = 'images/categoryImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }else{
            $imageName = $data->image;
        }

        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->image = $imageName;
        $data->save();
        if($data){
            return back()->with(['success'=>'A category has been Update!']);
        }else{
            return back()->with(['fail'=>'A category can not Update!']);
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
        $cat = Category::find($id);
        $image_path = public_path("\images\categoryImg\\").$cat->image;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $cat->delete();
        if($cat){
            return Redirect()->back()->with(['success'=>'A category has been deleted!']);
        }else{
            return Redirect()->back()->with(['fail'=>'Can not delete!']);
        }
    }
}
