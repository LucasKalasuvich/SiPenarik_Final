{{-- @extends('layouts.app')
@section('title', 'Login')
@section('styles')
@endsection
@section('content')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="d-flex justify-content-center">
  <div class="login-box justify-content-center">
    <h2>Signaty</h2>
    <form method="POST" action="{{ route('login') }}" class="user">
      @csrf
      <div class="user-box">
        <input type="text" class="@error('username') is-invalid @enderror" style="color: black; border-block-color: black" name="username" required autocomplete="off">
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label class="text-dark"><span class="fas fa-user"></span>Username</label>
      </div>
      <div class="user-box">
        <input type="password" class="@error('username') is-invalid @enderror" style="color: black; border-block-color: black" name="password" required autocomplete="off">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label class="text-dark"><span class="fas fa-lock"></span>Password</label>
      </div>
      <button type="submit" class="btn btn-lg d-flex justify-content-center" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <strong class="text-center">{{ __('Login') }}</strong>
      </button>
    </form>
    <div class="text-center mt-5" style="font-size: 10px">
      &copy; PUSTEKINFO 2022
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection --}}


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/signn.png') }}">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <meta name="theme-color" content="#1885ed">
  <title>SiPenarik - Home</title>


  <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s
    }
    
    /* Add Animation */
    @-webkit-keyframes animatetop {
      from {top:-300px; opacity:0} 
      to {top:0; opacity:1}
    }
    
    @keyframes animatetop {
      from {top:-300px; opacity:0}
      to {top:0; opacity:1}
    }
    
    /* The Close Button */
    .close {
      color: black;
      float: right;
      font-size: 24px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    
    .modal-header {
      padding: 2px 30px;
      justify-content: start;
      background-color: #ffff;
      color: black;
    }
    
    .modal-body {padding: 2px 16px;}
    
    .modal-footer {
      padding: 2px 16px;
      background-color: #ffff;
      color: white;
    }
    </style>
</head>

<body>
  <!-- Header -->
<header class="hdr mt-4">
  <input type="checkbox" id="menu-dis">
  <label for="menu-dis"><i class="fas fa-bars"></i></label>
  <label for="menu-dis"><i class="fas fa-times"></i></label>
  <!-- Logo -->
  <div class="logo">
    <h3 style="font-weight: bold">SIPENARIK</h3>
  </div>
  <!-- Nav Menu -->
  {{-- <ul class="menu"> --}}
    {{-- <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li> --}}
    {{-- <a class="get-btn" href="#">Login Now</a> --}}
    <button type="button" class="btn btn-outline-dark btn-sm rounded-4" id="myBtn">
      <div class="button"><i class="fas fa-cloud-upload-alt fa-sm"></i>Login Now</div>
    </button>
  {{-- </ul> --}}
</header>

<!-- Container -->
<div class="container mt-3">
  <!-- Content -->
  <div class="content">
    <h2>Sistem Penandatanganan Elektronik</h2>
    <p>SiPenarik Adalah Sebuah Website Untuk Melakukan Proses Tanda Tangan Elektronik Dengan Simple Dan Terpercaya. Selesaikan Pekerjaan Jauh Lebih Cepat Dan Praktis Dengan Menggunakan Website SiPenarik.</p>
    {{-- <button type="button" class="btn btn-outline-dark btn-lg" id="myBtn">
      <div class="button"><i class="fas fa-cloud-upload-alt fa-lg"></i>Mulai</div>
    </button> --}}
    
  </div>
  <!-- Image -->
  <div class="bg-image">
    <img src="https://media.istockphoto.com/id/1167143989/id/vektor/kontrak-elektronik-atau-konsep-tanda-tangan-digital-gaya-kartun-datar-modern-ilustrasi-vektor.jpg?s=170667a&w=0&k=20&c=5FJzuyi5jeptIvKNfXU8we80jo_jjH9tIDP-f5YADPQ=" alt="background">
  </div>
</div>



<!-- Footer -->
<footer class="ftr">
  <p>Copyright &copy; 2022-2023 SiPenarik</p>
</footer>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <form method="POST" action="{{ route('login') }}" class="user">
        @csrf
        <h2 class="mt-3" style="font-size: 1.5rem">Login</h2>
        <hr width="65px">
        @error('username')
          <div class="alert alert-danger alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">x</button>	 --}}
            <strong>Username Dan Password Salah!</strong>
          </div>
        @enderror
        @error('password')
          <div class="alert alert-danger alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">x</button>	 --}}
            <strong>Username Dan Password Salah!</strong>
          </div>
        @enderror
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input class="form-control @error('username') is-invalid @enderror" name="username" type="username" id="form2Example1" required autocomplete="off"/>
          <label class="form-label" for="form2Example1">Username</label>
        </div>
      
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="form2Example2" required autocomplete="off"/>
          <label class="form-label" for="form2Example2">Password</label>
        </div>       
      
        <!-- Submit button -->
        {{-- <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('Login') }}</button> --}}
        <button type="submit" class="btn btn-outline-dark btn-lg rounded-4 mb-4">
          <div class="button"><i class="fas fa-cloud-upload-alt fa-lg"></i>{{ __('Login') }}</div>
        </button>
      </form>
    </div>
    
  </div>

</div>


<script>
  // id modal
  var modal = document.getElementById("myModal");
  
  // Buat Buka Button
  var btn = document.getElementById("myBtn");
  
  // Tutup Modal
  var span = document.getElementsByClassName("close")[0];
  
  // Buka Button modal ketika user klik
  btn.onclick = function() {
    modal.style.display = "block";
  }
  
 
  span.onclick = function() {
    modal.style.display = "none";
  }
  

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  </script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
