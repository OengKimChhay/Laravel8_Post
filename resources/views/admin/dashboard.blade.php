@extends('admin.Admin_dashboard')
@section('title','Admin dashboard')

@section('content')
         <h5 class="mb-2 mt-4">Dashboard</h5>
         <div class="row">
                    <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{App\Models\User::count()}}</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{route('allUser')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{App\Models\Comment::count()}}</h3>
                <p>Comments</p>
              </div>
              <div class="icon">
                <i class="fas fa-comments"></i>
              </div>
              <a href="{{route('allComment')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{App\Models\Category::count()}}</h3>
                <p>Category</p>
              </div>
              <div class="icon">
                <i class="fas fa-bars"></i>
              </div>
              <a href="{{route('category.index')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{App\Models\Post::count()}}</h3>
                <p>Post</p>
              </div>
              <div class="icon">
                <i class="fas fa-image"></i>
              </div>
              <a href="{{route('post.index')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>

<!-- for posts -->
<!-- for admin posts -->
@if(Session::has('success'))
<div class="alert alert-danger" role="alert">
   {{Session::get('success')}}
</div>
@elseif(Session::has('fail'))
<div class="alert alert-warning" role="alert">
   {{Session::get('fail')}}
</div>
@endif
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Admin Posts</h3>
        </div>
         <div class="card-body">
            <table class="table table-bordered">
               <thead>
                 <tr>
                     <th style="width: 10px">ID</th>
                     <th>Title</th>
                     <th>Detail</th>
                     <th>Category Name</th>
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($adminPost as $item)
                  <tr>
                     <td>{{$item->id}}</td>
                     <td>{{$item->title}}</td>
                     <td>{{$item->detail}}</td> 
                     @foreach($cat as $cats)
                     @if($item->cat_id == $cats->id)
                     <td>{{$cats->title}}</td>
                     @endif
                     @endforeach  
                     <td><img style="height:45px;" src="{{asset('images/postImg/'.$item->full_img)}}" alt="{{$item->title}}"></td>
                     <td style="display:flex; flex-direction:row;">
                        <a  href="{{route('post.show',$item->id)}}" class="btn btn-outline-primary">View</a>
                        <a href="{{route('post.edit',$item->id)}}" class="btn btn-outline-primary">Update</a>
                        <form action="{{route('post.destroy',$item->id)}}" method="post">
                           @csrf 
                           @method('DELETE') <!--we need to use this method if we use resource controller-->
                           <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                     </td>
                 </tr>
                    @endforeach
               </tbody>
            </table>            
            </div>
         </div>
         <div class="d-flex justify-content-center">
            {{ $adminPost->links() }}
         </div>
      </div>
   </div>
</div>

<!-- for user posts -->
<div class="container-fluid mt-3">
   <div class="row">
      <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">User Posts</h3>
        </div>
            <table class="table table-bordered">
               <thead>
                 <tr>
                     <th style="width: 10px">ID</th>
                     <th>Title</th>
                     <th>Detail</th>
                     <th>Category Name</th>
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($userPost as $item)
                  <tr>
                     <td>{{$item->id}}</td>
                     <td>{{$item->title}}</td>
                     <td>{{$item->detail}}</td> 
                     @foreach($cat as $cats)
                     @if($item->cat_id == $cats->id)
                     <td>{{$cats->title}}</td>
                     @endif
                     @endforeach  
                     <td><img style="height:45px;" src="{{asset('images/postImg/'.$item->full_img)}}" alt="{{$item->title}}"></td>
                     <td style="display:flex; flex-direction:row;">
                        <a  href="{{route('post.show',$item->id)}}" class="btn btn-outline-primary">View</a>
                        <form action="{{route('post.destroy',$item->id)}}" method="post">
                           @csrf 
                           @method('DELETE') <!--we need to use this method if we use resource controller-->
                           <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                     </td>
                 </tr>
                    @endforeach
               </tbody>
            </table>            
            </div>
         </div>
         <div class="d-flex justify-content-center">
            {{ $userPost->links() }}
         </div>
      </div>
   </div>
</div>

@endsection