@extends('admin.Admin_dashboard')
@section('title','All Categories')

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
      <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">All Categories</h3>
        </div>
         <div class="card-body">
         @if(Session::has('success'))
         <div class="alert alert-danger" role="alert">
            {{Session::get('success')}}
         </div>
         @elseif(Session::has('fail'))
         <div class="alert alert-warning" role="alert">
            {{Session::get('fail')}}
         </div>
         @endif
            <table class="table table-bordered">
               <thead class="thead-light">
                 <tr>
                     <th style="width: 10px">ID</th>
                     <th>Title</th>
                     <th>Detail</th>
                     <th>Image</th>
                     <th>Created at</th>
                     <th>Updated at</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data as $item)
                  <tr>
                     <td>{{$item->id}}</td>
                     <td>{{$item->title}}</td>
                     <td>{{$item->detail}}</td>
                     <td><img style="height:45px;" src="{{asset('images/categoryImg/'.$item->image)}}" alt="{{$item->title}}"></td>
                     <td>{{date('F d, Y', strtotime($item->created_at->setTimezone('Asia/Phnom_Penh')))}} at {{date('g:i A ', strtotime($item->created_at->setTimezone('Asia/Phnom_Penh')))}}</td>
                     <td>{{date('F d, Y', strtotime($item->updated_at->setTimezone('Asia/Phnom_Penh')))}} at {{date('g:i A ', strtotime($item->updated_at->setTimezone('Asia/Phnom_Penh')))}}</td>
                     <td style="display:flex; flex-direction:row;">
                        <a  href="{{route('category.show',$item->id)}}" class="btn btn-outline-primary">View</a>
                        <a href="{{route('category.edit',$item->id)}}" class="btn btn-outline-primary">Update</a>
                        <form action="{{route('category.destroy',$item->id)}}" method="post">
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
            {{ $data->links() }}
         </div>
      </div>
   </div>
</div>

@endsection