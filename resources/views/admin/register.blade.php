<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- bootstrap 5 -->
   <link href="{{asset('bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet">
   <title>Admin Register</title>
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
            <form action="{{route('store.form')}}" method="POST" enctype="multipart/form-data">
            @csrf
               <div class="card">
                  <div class="card-header text-center" style="font-size:20px;">Admin Register</div>
                  <div class="card-body">
                     @if(Session::has('success'))
                     <div class="alert alert-primary" role="alert" style="padding:4px;">
                        {{Session::get('success')}}
                     </div>
                     @elseif(Session::has('error'))
                     <div class="alert alert-danger" role="alert" style="padding:4px;">
                        {{Session::get('error')}}
                     </div>
                     @endif
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') invalid @enderror" name="username" autocomplete="username" value="{{old('username')}}">
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
                     <div class="form-group">
                        <label for="re_password">Confirm Password</label>
                        <input type="password" class="form-control" name="re_password" autocomplete="re_password">
                     </div>
                     <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" type="file" class="form-control @error('username') invalid @enderror" alt="image" name="image" autocomplete="image">
                        @error('image') 
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="mt-3">        
                           <img style="width:250px;" alt="image" id="preview" src="">
                        </div>  
                     </div>
                     <div class="form-group">
                        <input type="checkbox" name="check" class="form-control-input">
                        <label for="check">Stay Login</label>
                     </div>
                     <div class="form-group mt-3">
                        <button class="btn btn-primary" type="submit">Register</button>
                     </div>
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
<script type="text/javascript">
      $('#image').change(function(evnet){
         $('#preview').attr('src',URL.createObjectURL(evnet.target.files[0]));
      });

      // one way also work ;)
      // $('#image').change(function(evnet){
      //    var reader = new FileReader();
      //    reader.onload = (e) => {
      //       $('#preview').attr('src', e.target.result);
      //    }
      //    reader.readAsDataURL(this.files[0]);
      // });
   
</script>
</body>
</html>