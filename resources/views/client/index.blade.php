@extends('layouts.app')
@section('title', 'Home')
@section('styles')
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="{{ asset('css/card2.css') }}">
	<link rel="stylesheet" href="css/calendar.css">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> --}}

  {{-- <link rel="stylesheet" href="{{ asset('css/calendar.css') }}"> --}}
  
  <style>
    .select2-container .select2-selection--single {
      display: block;
      width: 100%;
      height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 2;
      color: #6e707e;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #d1d3e2;
      border-radius: .35rem;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #6e707e;
      line-height: 28px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      padding-left: 0;
      padding-right: 0;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-top: -2px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: calc(1.5em + .75rem + 2px);
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px;
    }
  </style>
@endsection
@section('content')
<h5 style="font-family: Verdana, Arial, Helvetica, sans-serif;">Dashboard</h5>

    <div class="row mt-3 d-flex justify-content-center">
      <div class="col-xl-6">
        <div class="card bg-light mb-3" style="border-radius: 15px">
          <div class="card-header" >Upload File</div>
          <div class="card-body">
            <p class="card-text">Upload your file here!</p>
            <button
                  type="button"
                  class="btn btn-outline-primary mt-2"
                  data-toggle="modal"
                  data-target="#add-modal"
                >
                <div><i class="fas fa-cloud-upload-alt"></i>&nbsp; Upload File</div>
            </button>
          </div>
        </div>
        <div class="card bg-light mb-3" style="border-radius: 15px">
          <div class="card-header" >File Uploaded</div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-8">
                <a href="/upload"><button class="btn btn-outline-info mt-5"><i class="fas fa-info-circle"></i>&nbsp;Go</button></a>
              </div>
              <div class="col-xl-4 d-flex justify-content-end">
                <span class="bg-warning p-3 m-3 text-center text-dark" style="font-size: 25px; border-radius:5px;">{{ $allfile }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card bg-light mb-3" style="border-radius: 15px">
          <div class="card-header">Signature Request</div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-8">
                <a href="/meminta"><button class="btn btn-outline-info mt-5"><i class="fas fa-info-circle"></i>&nbsp;Go</button></a>
              </div>
              <div class="col-xl-4 d-flex justify-content-end">
                <span class="bg-warning p-3 m-3 text-center text-dark" style="font-size: 25px; border-radius:5px;">{{ $request }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="card bg-light mb-3" style="border-radius: 15px">
          <div class="card-header">Permintaan</div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-8">
                <a href="/permintaan"><button class="btn btn-outline-info mt-5"><i class="fas fa-info-circle"></i>&nbsp;Go</button></a>
              </div>
              <div class="col-xl-4 d-flex justify-content-end">
                <span class="bg-warning p-3 m-3 text-center text-dark" style="font-size: 25px; border-radius:5px;">{{ $requested_file  }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
  <div
  class="modal fade"
  id="add-modal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><h4>Upload File</h4></h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="file" class="form-label"><h5>Silahkan Unggah File</h5></label>
              <div class="form-group mt-3">
                <input type="file" class="@error('file')is-invalid
                @enderror" id="file" name="file[]" multiple>
                @error('file')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror 
            </div>
            <i class="text-danger">* Allowed file extensions : "pdf only"</i>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Kembali
            </button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="border-radius:13px;">
            <div class="modal-header">
                <h3 class="modal-title" style="font-size:14px"><strong>PENTING !</strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <span class="d-flex justify-content-center"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="black" class="bi bi-lock-fill" viewBox="0 0 16 16">
  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
</svg></span>
<br>
			  <p class="text-danger" style="font-size: 16px"><strong>Jika Anda Belum Memiliki PIN, Silahkan Membuat Terlebih Dahulu di Profile -> Buat PIN <a class="text-primary" href="{{ route('pengaturan') }}">(Klik Disini !)</a>. Agar Anda Dapat Melakukan Langkah Selanjutnya.</strong></p>
              <br>
              <p class="text-info" style="font-size: 16px"><i>Abaikan Jika Sudah Memiliki PIN</i></p>
            </div>

            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
  </div>
</div>
@endsection
@section('script')
   {{-- <script src="js/jquery.min.js"></script> --}}
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    $(document).ready(function () {

var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= [ "Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday" ];

var newDate = new Date();
newDate.setDate(newDate.getDate());
	
setInterval( function() {
	var hours = new Date().getHours();
	$(".hour").html(( hours < 10 ? "0" : "" ) + hours);
    var seconds = new Date().getSeconds();
	$(".second").html(( seconds < 10 ? "0" : "" ) + seconds);
    var minutes = new Date().getMinutes();
	$(".minute").html(( minutes < 10 ? "0" : "" ) + minutes);
    
    $(".month span,.month2 span").text(monthNames[newDate.getMonth()]);
    $(".date span,.date2 span").text(newDate.getDate());
    $(".day span,.day2 span").text(dayNames[newDate.getDay()]);
    $(".year span").html(newDate.getFullYear());
}, 1000);	



$(".outer").on({
    mousedown:function(){
        $(".dribbble").css("opacity","1");
    },
    mouseup:function(){
        $(".dribbble").css("opacity","0");
    }
});



});
  </script>
  <script>
     $(document).ready(function(){
      $("#myModal").modal('show');
    });
  </script>
@endsection