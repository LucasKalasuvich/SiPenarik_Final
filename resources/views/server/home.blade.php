@extends('layouts.app')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('style')
    
@endsection

@section('content')
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-xl-5 mt-3">
          <div class="card border-left-primary shadow ">
            <a href="/user" style="text-decoration: none"> 
              <div class="card-body h-100">
                <div class="no-gutters align-items-center">
                  <div class="col mr-1">
                    <div><h5 class="font-weight-bold text-primary text-uppercase mb-1">Data Users</h5></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                  </div>
                  <div class="row justify-content-end mt-5">
                    <div class="mr-1">
                      <i class="" style="opacity: 0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                          <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                          <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                          <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                      </i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 

        <div class="col-xl-7 mt-3">
          <div class="card border-left-danger shadow ">
            <a href="/upload" style="text-decoration: none">
              <div class="card-body h-100">
                <div class="no-gutters align-items-center">
                  <div class="col mr-1">
                    <div><h5 class="font-weight-bold text-danger text-uppercase mb-1">Upload File</h5></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $allfile }}</div>
                  </div>
                  <div class="row justify-content-end mt-5">
                    <div class="mr-1">
                      <i class="" style="opacity: 0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/>
                        </svg>
                      </i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-xl-7 mt-3">
          <div class="card border-left-warning shadow ">
            <a href="/meminta" style="text-decoration: none">
              <div class="card-body h-100">
                <div class="no-gutters align-items-center">
                  <div class="col mr-1">
                    <div><h5 class="font-weight-bold text-warning text-uppercase mb-1">Meminta Tanda Tangan</h5></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $request }}</div>
                  </div>
                  <div class="row justify-content-end mt-5">
                    <div class="mr-1">
                      <i class="" style="opacity: 0.5;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="yellow" class="bi bi-award-fill" viewBox="0 0 16 16">
                          <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
                          <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                        </svg>
                      </i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-xl-5 mt-3">
          <div class="card border-left-success shadow ">
            <a href="/permintaan" style="text-decoration: none">
              <div class="card-body h-100">
                <div class="no-gutters align-items-center">
                  <div class="col mr-1">
                    <div><h5 class="font-weight-bold text-success text-uppercase mb-1">Permintaan Tanda Tangan</h5></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $requested_file }}</div>
                  </div>
                  <div class="row justify-content-end mt-5">
                    <div class="mr-1">
                      <i class="" style="opacity: 0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                          <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                        </svg>
                      </i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        {{-- <div class="col-xl-5 ml-3 shadow">
            <link href="{{ asset('css/chart.css') }}" rel="stylesheet"/>
            <figure class="highcharts-figure">
              <div id="container"></div>
              <p class="highcharts-description"></p>
            </figure>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="{{ asset('js/chart.js') }}"></script>
@endsection