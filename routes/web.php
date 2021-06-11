<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
   // for user effect
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});
Route::group(['middleware'=>'PreventBackHistory'],function(){

   // for home page (show all post)
   Route::get('/',[HomeController::class,'home']);

   // for post detail
   Route::get('/post/{id}',[HomeController::class,'detail'])->name('postDetail');

   // for show post with same category in home page (header view)
   Route::get('/post/{catTitle}/{catid}',[HomeController::class,'allPostWithCat'])->name('allPostCat');

   Route::group(['middleware'=>'auth'],function(){
      //->middleware('auth') mean that till user login firt otherwise they can not comment or post something
      // for post comment save
      Route::post('/post-comment/{id}',[CommentController::class,'saveComment'])->name('post-comment'); 
      // for save comment reply
      Route::post('/post-comment/{com_id}/reply',[CommentReplyController::class,'saveCommentReply'])->name('comReply'); 
      // add post form user
      Route::get('/add-post',[UserController::class,'addPost'])->name('addPostByUser');
      Route::post('/add-post',[UserController::class,'savePost'])->name('savePost');
   });

   // show all comments
   Route::get('/admin/commnet',[CommentController::class,'showCmm'])->name('allComment');
   Route::get('/admin/comment-delete/{id}',[CommentController::class,'deleteCom'])->name('deleteCom');


   // for add admin
   Route::get('/admin/register',[AdminController::class,'register'])->name('register.form');
   Route::post('/admin/register',[AdminController::class,'store'])->name('store.form');

   // for login admin
   Route::get('/admin',[AdminController::class,'login'])->name('login.form');
   Route::post('/admin/login',[AdminController::class,'submitLogin'])->name('submit.Login');

   // for edit and update admin
   Route::get('/admin/setting/{id}',[AdminController::class,'profileAndedit'])->name('profileAndedit');
   Route::post('/admin/setting/{id}',[AdminController::class,'profileAndupdate'])->name('profileAndupdate');

   // for logout admin
   Route::get('/admin/logout',[AdminController::class,'logout'])->name('logoutAdmin');

   Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
   Route::resource('/admin/category',CategoryController::class);

   // for post crud belongto admin
   Route::resource('/admin/post',PostController::class);

   // show all users
   Route::get('/admin/user',[UserController::class,'allUser'])->name('allUser');
   Route::get('/admin/user-delete/{userId}',[UserController::class,'deleteUser'])->name('deleteUser');




   
}); //end route prevent back histroy

// this is how to share data to all view blade
// View::composer(['*'],function($view){ // '*' mean that we can share data to all view but if we want to specific view we can ['admin.category','home',...] mean file name
//    $user = Auth::user();  //we can share data table as well
//    $view->with('USER',$user);  //USER is variable we use all view
// });