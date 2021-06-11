<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use Auth;

class AdminController extends Controller
{
    function register(){
        return view('admin.register');
    }

    function profileAndedit($id){
        $admin = Admin::find($id);
        return view('admin.profile',['data'=>$admin]);
    }

    function profileAndupdate(Request $request,$id){
        $admin = Admin::where('id',$id)->first();
        $request->validate([
            'username' => 'required',
            'currentpass'=>'required',
            'newpass'=>'required|same:confirmpass',
            'confirmpass'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // check current pass
        if($request->currentpass !== $admin->password){
            return back()->with(['notMatch'=>'The current password not match']);
        }
        // check image
        if($request->hasFile('image')){
            $image_path = public_path("\images\adminImg\\").$admin->image;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $image = $request->file('image');
            $desitate_path = 'images/adminImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }else{
            $imageName = $admin->image;
        }
        $admin->username = $request->username;
        $admin->password = $request->newpass;
        $admin->image = $imageName;
        $admin->save();
        if($admin){
            return redirect()->route('logout');
        }else{
            return redirect()->back()->with(['fail'=>'Can not Update!']);
        }
    }

    function store(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password'=>'required|same:re_password',
            're_password'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // check file
        if($request->hasFile('image')){
            $image = $request->file('image');
            $desitate_path = 'images/adminImg';
            $imageName = time().'.'.$request->image->getClientOriginalName(); // to get image name and convert to number;            $img_resize->move($desitate_path,$imageName); //to store image
            $image->move($desitate_path,$imageName);
        }
        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password = $request->password;
        $admin->image = $imageName;
        $admin->save();
        if($admin){
            $check = $request->check; //check if checkbox is cheked on way if($req->has('check)){..}
            if($check){
                $request->session()->put('username',$admin->username);
                $request->session()->put('image',$admin->image);
                $request->session()->put('id',$admin->id);
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('login.form');
            }
        }else{
            return back()->with(['error'=>'Can not Register!']);
        }
    }

    function login(){
        return view('admin.login');
    }
    
    function submitLogin(Request $req){
        $this->validate($req,[
            'username' => 'required|exists:admins,username',
            'password' => 'required'
        ]);
        $checkAdmin = Admin::where(['username'=>$req->username, 'password'=>$req->password])->get();
        // if success login admin
        if(count($checkAdmin)>0){ 
            $checkAdmin = Admin::where(['username'=>$req->username, 'password'=>$req->password])->first();
            $req->session()->put('username',$checkAdmin->username);
            $req->session()->put('image',$checkAdmin->image);
            $req->session()->put('id',$checkAdmin->id);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['Error'=>'Wrong Username or Password']);
        }
    }
    function dashboard(){
        $adminPost = Post::where('user_id','0')->paginate(5);
        $userPost = Post::where('user_id','>','0')->paginate(5);
        $cat = Category::all();
        return view('admin.dashboard',['cat'=>$cat,'adminPost'=>$adminPost,'userPost'=>$userPost]);
    }
    
    function logout(Request $req){
        $req->session()->forget('username'); //delete all session data
        $req->session()->forget('image');
        $req->session()->forget('id');
        return redirect()->route('login.form');
    }

}
