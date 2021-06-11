@extends('layouts.header')
@section('title','Post Detail')

@section('content')
<!-- post -->
  <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="row">
        @if(count($allPostCat)>0)
            @foreach($allPostCat as $posts)
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                <img class="card-img-top" src="{{asset('/images/postImg/'.$posts->full_img)}}" alt="image" style="width:100%;">
                    <div class="card-body">
                        <a href="{{route('postDetail',$posts->id)}}">{{$posts->title}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <p>There is no post</p>
        @endif
        </div>
        <div class="container d-flex justify-content-center">
            {{$allPostCat->links()}}
        </div>
    </div>
    <!-- right side bar -->
    <div class="col-lg-4 col-md-12 col-sm-12">
    <!-- search -->
      <div class="card shadow">
        <div class="card-header">
          Search
        </div>
        <div class="card-body">
          <form action="{{url('/')}}" class="d-flex">
            <input name="search" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
          </form>
        </div>
      </div>
      <!-- recent post -->
      <div class="card mt-4 shadow">
        <div class="card-header">
          Recent Post
        </div>
        <div class="list-group list-group-flush">
          @if($recent_post)
          @foreach($recent_post as $post)
          <div class="list-group-item">
            <a href="{{route('postDetail',$post->id)}}" ><img class="card-img-top" src="{{asset('/images/postImg/'.$post->full_img)}}" alt="image" style="width:60px;"><span class="m-2">{{$post->title}}</span></a> 
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <!-- popular post -->
      <div class="card mt-4 shadow">
        <div class="card-header">
          Popular Post
        </div>
        <div class="card-body">
          @if($popular_post)  <!--go to appserviseprovider u will se $popular_post valiable-->
          @foreach($popular_post as $pop_post)
          <div class="list-group-item d-flex justify-content-between">
            <div>
              <a href="{{route('postDetail',$pop_post->id)}}" ><img class="card-img-top" src="{{asset('/images/postImg/'.$pop_post->full_img)}}" alt="image" style="width:60px;"><span class="m-2">{{$pop_post->title}}</span></a> 
            </div>
            <span class="text-primary">view: {{$pop_post->views}}</span> 
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection