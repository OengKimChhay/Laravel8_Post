@extends('admin.Admin_dashboard')
@section('title','Create Category')

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
      <div class="col-lg-6 offset-lg-3">
         <div class="card">
            <div class="card-header p-2">
               <string class="m-0">Add Category</strong>
            </div>
            <div class="card-body p-3">
               @if(Session::has('success'))
                  <div class="alert alert-primary p-2" role="alert">{{Session::get('success')}}</div>
               @endif
               <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('POST')
                  <div class="form-group">
                     <label for="title" class="m-0">Title</label>
                     <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{old('title')}}" autocomplete="title">
                     @error('title')
                        <p class="text-danger">{{$message}}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="detail" class="m-0">Detail</label>
                    <input type="text" name="detail" class="form-control" id="detail" placeholder="Detail" value="{{old('detail')}}" autocomplete="detail">
                     @error('detail')
                        <p class="text-danger">{{$message}}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="image">Image:</label>
                     <input id="image"  name="image" type="file" class="form-control " placeholder="Choose Image" autocomplete="image">
                     @error('image')
                        <p class="text-danger">{{$message}}</p>
                     @enderror   
                     <div class="mt-3">        
                        <img style="width:250px;" alt="image" id="preview" src="">
                     </div>                    
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Category</button>
               </div>
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