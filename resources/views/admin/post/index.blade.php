@extends('admin.Admin_dashboard')
@section('title','All Posts')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 d-flex justify-content-center">
         <h3>Welcome to Posts</h3>
      </div>
   </div>
</div>

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