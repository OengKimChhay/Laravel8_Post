<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- for bootstrap -->
   <link href="{{asset('/bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet">
   <script src="{{asset('/bootstrap-5/js/bootstrap.min.js')}}"></script>
   <!-- for jquery -->
   <script src="{{asset('/jquery-3.6.0/jquery-3.6.0.min.js')}}"></script>
   <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- show all categories in header-->
            @if($allCategories && count($allCategories) >0) <!--$allCategories var is in AppServiseProvider -->
            @foreach($allCategories as $cat)
              <li><a class="dropdown-item" href="{{url('/post/'.Str::slug($cat->title).'/'.$cat->id)}}">{{$cat->title}}</a></li> <!--Str::slug($cat->title) this is to share cat title in the route url-->
            @endforeach
            @else
            <li><p>No Category</p></li>
            @endif
          </ul>
        </li>
        <!-- if user not logged in -->
        @guest
          @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
          @endif
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
        @else
        <!-- if user logged in -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="1navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="1navbarDropdown">
              <li><a class="dropdown-item" href="{{route('addPostByUser')}}">Add post</a></li>
              <li><a class="dropdown-item" href="#">Setting</a></li>
              <li>
                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                </form>
              </li>
          </ul>
        </li>
        @endguest
      </ul>
      <!-- for search nav bar -->
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<main class="container mt-5">
 @yield('content')
</main>

@yield('script')
</body>
</html>