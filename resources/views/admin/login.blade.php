<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- bootstrap 5 -->
   <link href="{{asset('bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet">
   <title>Admin Login</title>
   <style>
      *{
         margin:0;
         padding:0;
      }
      body{
         min-height:100vh;
         display:flex;
         justify-content: center;
         align-items:center;
         background-color:#EEF2F7;
      }
      .invalid{
         border:3px solid rgb(205 26 26 / 58%);
      }
      .card{
         box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                     0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                     0 12.5px 10px rgba(0, 0, 0, 0.06),
                     0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                     0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                     0 60px 80px rgba(0, 0, 0, 0.12);
         border-radius: 5px;
         background: white;
      }
   </style>
</head>
<body>

   <div class="container">
      <div class="row">
         <div class="col col-lg-4 col-md-5 col-sm-12 offset-md-4">   
            <form action="{{route('submit.Login')}}" method="POST">
            @csrf
               <div class="card">
                  <div class="card-header text-center" style="font-size:20px;">Admin Login</div>
                  <div class="card-body">
                     @if(Session::has('Error'))
                     <div class="alert alert-danger" role="alert" style="padding:4px;">
                        {{Session::get('Error')}}
                     </div>
                     @endif
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') invalid @enderror" name="username" autocomplete="username">
                        @error('username') 
                        <small class="text-danger">{{$message}}</small>
                        @enderror 
                     </div>
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') invalid @enderror" name="password" autocomplete="password">
                        @error('password') 
                        <small class="text-danger">{{$message}}</small>
                        @enderror 
                     </div>
                     <div class="form-group mt-3">
                        <button class="btn btn-primary" type="submit">Login</button>
                     </div>
                  </div>
                  <div class="card-footer">
                     <a href="{{route('register.form')}}">Register</a>
                  </div>
               </div>
            </form>
         </div>
      </div>

   </div>
<!-- link bootstrap 5 -->
<script src="{{asset('bootstrap-5/js/bootstrap.min.js')}}"></script>
<!-- link jquery 3.6 -->
<script src="{{asset('jquery-3.6.0/jquery-3.6.0.min.js')}}"></script>
</body>
</html>