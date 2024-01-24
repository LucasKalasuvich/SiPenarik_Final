@extends('layouts.app')
@section('title', 'Pilih Penandatangan')
@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
  <div class="row">
    <div class="col-xl-12">
      <div class="container">
        <h3>Request Signature</h3>
        <div class="card mt-3">
                <div class="card-body h-auto">
                  <div class="ml-1">
                    <h4 class="mt-3">Pilih Penandatangan</h4>
                  </div>
                    <div class="box mt-3">
                      <!-- /.box-header -->
                      <div class="box-body mb-3">
                        <form class="form-container" method="POST" action="/requestsign/{{$upload->id}}">
                          @csrf
                          <div class="form-group form-group-md shadow-lg" >
                            <div class="" >
                              <select class="form-control selectpicker" id="nama" name="nama" data-live-search="true">
                                <option value="">-select-</option>
                                  @foreach ($user as $u)
                                        <option value="{{ $u->id }}" {{ $u->id == $u['nama'] ? 'selected' : '' }}>
                                          {{ $u['nama'] }}
                                  @endforeach
                              </select>

                            </div>
                          </div>

                          <div class="form-outline mb-4">
                            <label class="form-label" for="form4Example3">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                          </div>
                          <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                          </div>
                        </form>
                      </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.container -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/i18n/defaults-*.min.js"></script>

  <script>
    if(jQuery().select2) {
      $(".select2").select2();
    }
  </script>

  <script>
    AOS.init();
  </script>
  
  <script>
		$(function () {
			$('#lstFruits').multiselect({
				includeSelectAllOption: true
			});
			$('#btnSelected').click(function () {
				var selected = $("#lstFruits option:selected");
				var message = "";
				selected.each(function () {
					message += $(this).text() + " " + $(this).val() + "\n";
				});
			});
		});
	</script>
  
@endsection