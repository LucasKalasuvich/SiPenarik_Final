@extends('layouts.app')
@section('title', 'Approve/Decline')
@section('styles')
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="{{ asset('css/card.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <div class="row d-flex justify-content-center">
    <div class="col-xl-12">
      <div class="container">
        <div class="card mb-5">
            <div class="row card-body">
                <div class="ml-4">
                    <h4 class="mt-3">{{$upload->file->file}}
                       @if ($upload->status == "Waiting")
                      @if ($upload->status == "Waiting")
                              {{-- <button type="button" class="btn btn-lg btn-outline-warning ml-5">
                                <a href="{{ route('statusApproved', $upload->id) }}" onclick="return confirm('Yakin');" class="text-dark" style="text-decoration: none">Approve</a>
                              </button> --}}
                              <button type="button" class="btn btn-lg btn-outline-warning ml-5">
                                <a href="{{ route('statusApproved', $upload->id) }}" type="button" class="text-dark" style="text-decoration: none" data-toggle="modal" data-target="#add-modal">Approve</a>
                              </button>
                              <button type="button" class="btn btn-lg btn-outline-danger">
                                <a href="{{ route('statusDecline', $upload->id) }}" class="text-dark" style="text-decoration: none" data-toggle="modal" data-target="#decline-modal">Decline</a>
                              </button>
                    @endif
                      @endif
                    </h4>
                </div>
                <div class="col-xl-12">
                    <div class="embed-responsive embed-responsive-16by9 mt-2">
                        <iframe class="embed-responsive-item" src="{{asset('storage/app/public/Upload/'. $upload->file->file)}}"></iframe>
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
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><h4>Sign PIN</h4></h5>
                        <button
                          type="button"
                          class="close"
                          data-dismiss="modal"
                          aria-label="Close"
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('PIN.pinReq', $upload->id)}}" method="POST">
                        @csrf
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="pin" class="form-label"><h5>Masukkan PIN</h5></label> <br>
                            {{-- <label for="pin" class="form-label text-danger"><h6>Masukkan PIN</h6></label> --}}
                            {{-- <p class="text-danger" style="font-size: 13px">PENTING !</p> --}}
                            <p class="text-danger" style="font-size: 11px"><strong> PENTING ! <br> Jika Anda Belum Memiliki PIN, Silahkan Membuat Terlebih Dahulu di Profile -> Buat PIN <a href="{{ route('pengaturan') }}">(Klik Disini !)</a> . Agar Anda Dapat Melakukan Langkah Selanjutnya.</strong></p>
                            <div class="form-group mt-3">
                              <input type="text" autocomplete="off" class="form-control form-control-user @error('pin') is-invalid @enderror" name="pin" required placeholder="Masukkan PIN [minimal 4 Angka]">
                              @error('pin')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="moda-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>

              <div
                class="modal fade"
                id="decline-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><h4>Decline</h4></h5>
                        <button
                          type="button"
                          class="close"
                          data-dismiss="modal"
                          aria-label="Close"
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('Feed.Feedback', $upload->id)}}" method="POST">
                        @csrf
                        <div class="modal-body">
                          <div class="mb-3">
                            <div class="form-outline mb-2">
                              <label class="form-label" for="form4Example3">Keterangan Decline</label>
                              <textarea class="form-control" id="feedback" name="feedback" rows="2" required></textarea>
                            </div>
                            <label for="pin" class="form-label"><h5>Masukkan PIN</h5></label> <br>
                            <p class="text-danger" style="font-size: 11px"><strong> PENTING ! <br> Jika Anda Belum Memiliki PIN, Silahkan Membuat Terlebih Dahulu di Profile -> Buat PIN <a href="{{ route('pengaturan') }}">(Klik Disini !)</a> . Agar Anda Dapat Melakukan Langkah Selanjutnya.</strong></p>
                            <div class="form-group mt-3">
                              <input type="text" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control form-control-user @error('pin') is-invalid @enderror" name="pin" required placeholder="Masukkan PIN [minimal 8 Angka]">
                              @error('pin')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            {{-- <div class="moda-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
                            <div class="moda-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                      </form>
                     
                    </div>
                  </div>
              </div>

        </div>
      </div>
    </div>
 </div>
@endsection
@section('script')
  <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>

  <script>
    if(jQuery().select2) {
      $(".select2").select2();
    }
  </script>
  
  <script>
    AOS.init();
  </script>
  
@endsection