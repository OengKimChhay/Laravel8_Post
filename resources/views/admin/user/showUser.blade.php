@extends('admin.Admin_dashboard')
@section('title','All Users')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 d-flex justify-content-center">
         <h3>Welcome to Users</h3>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">All Users</h3>
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
               <thead>
                 <tr>
                     <th style="width: 10px">ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data as $user)
                  <tr>
                     <td>{{$user->id}}</td>
                     <td>{{$user->name}}</td>
                     <td>{{$user->email}}</td> 
                     <td>
                     <!-- check if user online -->
                        @if($user->isOnline())
                        <p class="text-success">Online</p>
                        @else
                        <p>Offline</p>
                        @endif
                     </td>
                     <td><a onClick="return confirm('Are you sure want to delete this user?')" href="{{route('deleteUser',$user->id)}}" class="btn btn-outline-danger">Delete</a></td>
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