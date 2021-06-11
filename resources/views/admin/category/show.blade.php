@extends('admin.Admin_dashboard')
@section('title','Detail Category')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 d-flex justify-content-center">
         <h3>Welcome to Category</h3>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-10 offset-lg-1">
      <div class="card">
         <div class="card-header">
            <h3 class="card-text">View Category</h3>
         </div>
         <div class="card-body d-flex">
            <div class="img" style="width:30%;">
               <img style="width:100%;" src="{{asset('images/categoryImg/'.$data->image)}}" alt="image">
            </div>
            <div class="detail ml-3" style="width:70%;">
               <h3 class="text-primary">{{$data->title}}</h3>
               <p>{{$data->detail}}</p>
            </div>
         </div>
         <div class="card-footer">
            <a href="{{route('category.index')}}" class="btn btn-primary">Go back</a>
         </div>
      </div>
   </div>
</div>

@endsection