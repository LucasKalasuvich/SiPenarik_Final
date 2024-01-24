@extends('layouts.app')
@section('title', 'CheckFile')
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
        <div class="card mb-5 w-100 h-100" style="display: flex">
            <div class="row card-body justify-content-center">
                <div class="">
                    <h4 class="mt-3">{{$upload->file->file}}</h4>
                </div>
                <div class="col-xl-12">
                    <div class="embed-responsive embed-responsive-16by9 mt-2">
                        <iframe class="embed-responsive-item" src="{{asset('storage/app/public/Upload/'. $upload->file->file)}}"></iframe>
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