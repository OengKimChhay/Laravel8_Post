@extends('admin.Admin_dashboard')
@section('title','Detail Post')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 d-flex justify-content-center">
         <h3>Welcome to Post</h3>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-10 offset-lg-1">
      <div class="card">
         <div class="card-header">
            <h3 class="card-text">View Post</h3>
         </div>
         <div class="card-body d-flex">
            <div class="img" style="width:30%;">
               <img style="width:100%;" src="{{asset('images/postImg/'.$data->full_img)}}" alt="image">
            </div>
            <div class="detail ml-3" style="width:70%;">
               <p class="text-primary">Title:<span class="text-gray">{{$data->title}}</span></p><br>
               <p class="text-primary">Category:
               @foreach($cat as $item)
                  @if($item->id == $data->cat_id)
                  <span class="text-gray">
                  {{$item->title}}
                  </span>
                  @endif
               @endforeach
               </p><br>
               <p class="text-primary">Detail:<span class="text-gray">{{$data->detail}}</span></p>
            </div>
         </div>
         <div class="card-footer">
            <a href="{{route('post.index')}}" class="btn btn-primary">Go back</a>
         </div>
      </div>
   </div>
</div>

@endsection