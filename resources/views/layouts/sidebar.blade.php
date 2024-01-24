<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:  #FFFF" id="accordionSidebar">

    
  @if(Auth::user()->level == 'Admin')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-1" href="{{ route('home') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <img src="{{ asset('img/signn.png') }}" class="img-fluid" alt="Sample image">
      </div>
      <div class="sidebar-brand-text mx-3 text-dark"><strong>SiPenarik</strong></div>
    </a>
    <div class="text-center d-none d-md-inline">
      <button class=" border-4 btn" id="sidebarToggle"></button>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard --> 
    <div class="sidebar-heading text-dark mt-3">
      Dashboard
    </div>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-home" style="color: black"></i>
        <span class="text-dark">Home</span></a>
    </li>

  

    <li class="nav-item">
      <a class="nav-link" href="{{ route('user.index') }}">
        <i class="fas fa-user" style="color: black"></i>
        <span class="text-dark">User</span></a>
    </li>
  @endif

  @if(Auth::user()->level == 'Users')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homeUser') }}">
      {{-- <div class="sidebar-brand-icon rotate-n-15">
        <img src="{{ asset('img/signn.png') }}" class="img-fluid" alt="Sample image">
      </div> --}}
      <div class="sidebar-brand-text mx-3 text-dark">
        SiPenarik
      </div>
    </a>
    <div class="text-center d-none d-md-inline">
      <button class=" border-4 btn" id="sidebarToggle"></button>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading text-dark mt-3">
      Dashboard
    </div>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('homeUser') }}">
        <i class="fas fa-home" style="color: black"></i>
        <span class="text-dark">Home</span></a>
    </li>
  @endif

  <div class="sidebar-heading text-dark mt-3">
    Menu
  </div>

  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-folder" style="color: black"></i>
      <span class="text-dark">File Manager</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="py-2 collapse-inner rounded" style="background-color:rgb(210, 232, 252)">
        <a class="collapse-item text-dark" href="/upload"><strong>Upload</strong> </a>
        <hr class="sidebar-divider my-0">
        <a class="collapse-item text-dark" href="/meminta"><strong>Meminta Tanda Tangan</strong></a>
        <hr class="sidebar-divider my-0">
        {{-- <a class="collapse-item text-dark" href="/uploaded">Uploaded</a> --}}
        <a class="collapse-item text-dark" href="/permintaan"><strong>Permintaan Tanda <br> Tangan</strong> </a>
        <hr class="sidebar-divider my-0">
        <a class="collapse-item text-dark" href="/signedFile"><strong>File Yang Sudah <br> Ditandatangani</strong> </a>
        {{-- <a class="collapse-item text-dark" href="/signed">Signed</a> --}}
      </div>
    </div>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link" href="/contactus">
      <i class="fas fa-comment-alt" style="color: black"></i>
      <span class="text-dark">Contact Us</span></a>
  </li> --}}

  <div class="sidebar-heading text-dark mt-3">
    Other
  </div>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('pengaturan') }}">
      <i class="fas fa-user" style="color: black"></i>
      <span class="text-dark">Profile</span></a>
  </li>

  {{-- <li class="nav-item">
    <a class="nav-link" href="/guide">
      <i class="fas fa-question" style="color: black"></i>
      <span class="text-dark">Panduan</span></a>
  </li> --}}
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fas fa-sign-out-alt" style="color: black"></i>
      <span class="text-dark">Log Out</span></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
</ul>
