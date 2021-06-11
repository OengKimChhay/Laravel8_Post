@extends('admin.Admin_dashboard')
@section('title','Edit Category')

@section('content')
<div class="container-fluid">
   <div class="row mb-2">
      <div class="col-lg-12 d-flex justify-content-between">
         <h3>Welcome to Category</h3>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-6 offset-lg-3">
         <div class="card">
            <div class="card-header p-2">
               <string class="m-0">Edit Category</strong>
            </div>
            <div class="card-body p-3">
               @if(Session::has('success'))
                  <div class="alert alert-primary p-2" role="alert">{{Session::get('success')}}</div>
               @elseif(Session::has('fail'))
                  <div class="alert alert-danger p-2" role="alert">{{Session::get('fail')}}</div>
               @endif
            <form action="{{route('category.update',$data->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('put') <!-- @method('put') we do have to add this code to specify method ortherwise it will automatic to show method -->
               <input name="id" type="hidden" value="{{$data->id}}">
               <div class="form-group mb-3">
                  <label for="title">Title:</label>
                  <input name="title" type="text" class="form-control " placeholder="Enter Title" value="{{$data->title}}" autocomplete="title"> 
                  @error('title')
                     <p class="text-danger">{{$message}}</p>
                  @enderror                                             
               </div>
               <div class="form-group mb-3">
                  <label for="detail">Detail:</label>
                  <input name="detail" type="text" class="form-control " placeholder="Enter Detail" value="{{$data->detail}}" autocomplete="detail"> 
                  @error('detail')
                     <p class="text-danger">{{$message}}</p>
                  @enderror                       
               </div>
               <div class="form-group mb-3">
                  <label for="image">Image:</label>
                  <input  id="image" name="image" type="file" class="form-control " placeholder="Choose Image" autocomplete="image">
                  @error('image')
                     <p class="text-danger">{{$message}}</p>
                  @enderror
                  <div class="mt-3">        
                     <img style="width:250px;" id="preview" src="{{asset('images/categoryImg/'.$data->image)}}">
                  </div>                       
               </div>
               <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
         </div>
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