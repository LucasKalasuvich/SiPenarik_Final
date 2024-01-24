@extends('layouts.app')
@section('title', 'Upload')
@section('styles')
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="{{ asset('css/card.css') }}">
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">

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

<div class="section_our_solution mt-2 ">
  <div class="row">
    <div class="col-xl-12">
      <div class="mt-1">
        <h3 class="p-2">Upload File</h3>
      </div>
      <div class="d-flex justify-content-start">
        <button type="button" class="btn btn-outline-primary btn-sm m-3" data-toggle="modal" data-target="#add-modal">
          <div class="button" > <i class="fas fa-cloud-upload-alt fa-lg"></i>&nbsp;Upload File</div>
        </button>
        <button style="margin-bottom: 10px" class="btn btn-outline-danger m-3 delete_all" data-url="{{ url('DeleteAll') }}"><i class="fas fa-trash-alt fa-lg"></i>&nbsp;Delete Selected Data</button>
      </div>
      <div class="card-body mb-5 shadow" style="display: flex">
      <div class="table-responsive">
        <table
          class="table table-bordered table-striped table-hover"
          id="dataTable"
          width="100%"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th width="50px"><input type="checkbox" id="master"></th>
              <td>No</td>
              <td>Nama File</td>
              <td>Tanggal Upload</td>
              {{-- <td>Status</td>
              <td>Download</td> --}}
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($upload as $data)
              <tr>
                <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <object data="{{$data['file']}}" type="application/pdf" width="100%" height="100%">
                    <p><a style="text-decoration: none; color:blue" href="/pilihTipe/{{encrypt($data->id)}}">{{$data['file']}}</a></p>
                  </object> 
                  {{-- <a href="{{asset('storage/app/public/Upload/'. $data['file'])}}" class="text-primary">{{$data['file']}} <br><br></a>  --}}
                </td>
                <td>{{$data->created_at}}</td>
                {{-- <td>
                  Menunggu --}}
                  {{-- @foreach ($req as $r)
                    {{$r->status}}
                  @endforeach --}}
                {{-- </td>
                <td></td> --}}
                <td>
                  <form
                    action="{{ route('upload.destroy', $data->id) }}"
                    method="POST"
                  >
                    @csrf
                    @method('delete')
                    <button
                      type="submit"
                      class="btn btn-danger btn-m btn-circle"
                      onclick="return confirm('Yakin');"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
    if(jQuery().select2) {
      $(".select2").select2();
    }
  </script>
  
  <script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
@endsection