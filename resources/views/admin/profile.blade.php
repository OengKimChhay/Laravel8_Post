@extends('admin.Admin_dashboard')
@section('title','Settings')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 p-3">
         <h3>Settings</h3>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
        <div class="col-lg-12">
                @if(Session::has('fail'))
                    <div class="card card-body bg-danger">{{Session::get('fail')}}</div>
                @endif   
            <form action="{{route('profileAndupdate',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card">
                    <div class="card card-body m-3 p-2 text-warning text-center" style="width:600px; font-size:17px;">Please remember after you were updated you will be go to log in again!</div>
                    <div class="card-header">
                        <h5>Photo</h5>
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="head" style="width:100px; height:100px ">
                            <img id="preview" class="card-img-top" src="{{asset('/images/adminImg/'.$data->image)}}" alt="img" style="width:100%;height:100%; border-radius:200px;" >
                        </div>
                        <div class="body mt-2">
                            <div class="custom-file" style="width:230px;">
                                <input id="image" name="image" type="file" class="custom-file-input">
                                <label class="custom-file-label">Select a new photo</label>
                                @error('image')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username"  placeholder="Username" value="{{$data->username}}">
                            @error('username')
                                <p class="text-danger">{{$message}}</p>
                            @enderror                            
                        </div>
                        <div class="form-group">
                            <label for="currentpass">Current Password</label>
                            <input type="password" class="form-control" name="currentpass"  placeholder="Current Password" >
                            @if(Session::has('notMatch'))
                                <p class="text-danger">{{Session::get('notMatch')}}</p>
                            @endif
                            @error('currentpass')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newpass">New Password</label>
                            <input type="password" class="form-control" name="newpass"  placeholder="New Password">
                            @error('newpass')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmpass">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmpass"  placeholder="Confirm Password">
                            @error('confirmpass')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
   </div>
</div>
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
@endsection