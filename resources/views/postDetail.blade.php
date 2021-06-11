@extends('layouts.header')
@section('title','Post Detail')

@section('content')
<!-- post -->
  <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
      <div class="row">
        <div class="col-lg-7 offset-lg-2">
          <div class="border border-1 p-2" style="font-size:12px;">
            {{date('F d, Y', strtotime($detail->created_at->setTimezone('Asia/Phnom_Penh')))}} at {{date('g:i A ', strtotime($detail->created_at->setTimezone('Asia/Phnom_Penh')))}}<br> {{$detail->created_at->diffForHumans()}} 
            <p class="text-dark">Views {{$detail->views}}</p>
          </div>
          <div class="card">
            <div class="card-hearder">
              <h3>{{$detail->title}}</h3>
            </div>
            <img class="card-img-top" src="{{asset('/images/postImg/'.$detail->full_img)}}" alt="image" style="width:100%;">
            <div class="card-body">
               <p>{{$detail->detail}}</p>
            </div>
          </div>

          <!-- add comments form-->
          <div class="card mt-3">
            <div class="card-header">Comments</div>
            <form action="{{route('post-comment',$detail->id)}}" method="post">
            @csrf
              <div class="card-body">
                @if (session('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                @if (session('fail'))
                    <p class="text-success">{{ session('fail') }}</p>
                @endif
                <textarea name="comment" class="form-control"></textarea>
                @error('comment')
                  <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-dark">Add comment</button>
              </div>
            </form>
          </div>
          
          <!-- show comment -->
          <div class="card mt-5 mb-5">
            <div class="card-header">
              Comments: <span class="text-primary">{{$detail->comments->count()}}</span>
            </div>
          @if($detail->comments)   <!--comments method that $detail point to is in the Post Model-->
          @foreach($detail->comments as $com)
            <div class="card-body p-2">
                  <h5 class="m-0">{{$com->user->name}}</h5><p style="font-size:10px; margin:0;">{{date('F d, Y', strtotime($com->created_at->setTimezone('Asia/Phnom_Penh')))}} at {{date('g:i A ', strtotime($com->created_at->setTimezone('Asia/Phnom_Penh')))}}</p>               
                  <p class="m-0">{{$com->comment}}</p>
                  <!-- for reply comment button-->
                  <a class="reply text-primary text-decoration-none" style="font-size:12px; cursor:pointer;">Reply</a>
                  
                  <!-- show reply coment -->
                  @if($com->replies->count()>0)
                    @foreach($com->replies as $reply)
                      <div class="border border-1" style="margin-left:20px;margin-top:5px;padding:5px;">
                      <h5 class="m-0">{{$reply->user->name}}</h5><p style="font-size:10px; margin:0;">{{date('F d, Y', strtotime($reply->created_at->setTimezone('Asia/Phnom_Penh')))}} at {{date('g:i A ', strtotime($reply->created_at->setTimezone('Asia/Phnom_Penh')))}}</p>
                        <p class="m-0">{{$reply->comment_reply}}</p>
                      </div>
                    @endforeach
                  @endif 
                  <!--end show reply coment -->

                  <!-- for reply comment form-->
                  <div class="reply-form">
                    <form action="{{route('comReply',$com->id)}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="exampleFormControlTextarea3">Comment</label>
                        <textarea name="replyCom" class="form-control" rows="1"></textarea>
                        @error('replyCom')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <button class=" btn btn-success p-0 mt-2" type="submit">Reply</button>
                    </form>
                  </div>
                  <!--end for reply comment form -->
                  
            </div><hr>
          @endforeach
          @endif
          </div>
        </div>
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
          @if($recent_post)  <!--go to appserviseprovider u will se $resent_post valiable-->
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
        <div class="list-group list-group-flush">
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
  </div>
@endsection

@section('script')

<script>
    $(function(){
      $('.reply-form').hide();
      $('.reply').click(function(e) {
        e.preventDefault();
        var replyForm = $(this).siblings('.reply-form');
        $(replyForm).toggle(100);
      });
    });
  </script>
@endsection