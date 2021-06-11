@extends('admin.Admin_dashboard')
@section('title','Edit Post')

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
               <string class="m-0">Edit Post</strong>
            </div>
            <div class="card-body p-3">
               @if(Session::has('success'))
                  <div class="alert alert-primary p-2" role="alert">{{Session::get('success')}}</div>
               @elseif(Session::has('fail'))
                  <div class="alert alert-danger p-2" role="alert">{{Session::get('fail')}}</div>
               @endif
            <form action="{{route('post.update',$data->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('put') <!--@method('put') we do have to add this code to specify method ortherwise it will automatic to show method -->
               <input name="id" type="hidden" value="{{$data->id}}">  <!--we have to add this-->
               <div class="form-group">
                     <label for="category" class="m-0">Category</label>
                     <select name="category" class="form-control" >
                        <option value="">Selete Catagory</option>
                        @foreach($cat as $item)
                           @if($item->id == $data->cat_id)
                           <option selected value="{{$item->id}}">{{$item->title}}</option>
                           @else
                           <option value="{{$item->id}}" {{(old('category')==$item->id)? 'selected':''}}>{{$item->title}}</option>
                           @endif
                        @endforeach
                     </select>
                     @error('category')
                        <p class="text-danger">{{$message}}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="title" class="m-0">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{$data->title}}" autocomplete="title">
                     @error('title')
                        <p class="text-danger">{{$message}}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="detail" class="m-0">Detail</label>
                    <input type="text" name="detail" class="form-control" id="detail" placeholder="Detail" value="{{$data->detail}}" autocomplete="detail">
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
                        <img style="width:250px;" alt="image" id="preview" src="{{asset('images/postImg/'.$data->full_img)}}">
                     </div>                    
                  </div>
                  <div class="form-group">
                     <label for="tag">Tag:</label>
                     <input id="tag"  name="tag" type="text" class="form-control " placeholder="Choose Tag" autocomplete="tage" value="{{$data->tag}}">
                     @error('tag')
                        <p class="text-danger">{{$message}}</p>
                     @enderror                    
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Edit Post</button>
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