@extends('layouts.app')
@section('title', 'Meminta Tanda Tangan')
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
        <h3 class="p-2">Signature Request</h3>
      </div>
      <div class="d-flex justify-content-start ml-3">
        <button style="margin-bottom: 10px" class="btn btn-outline-danger delete_all" data-url="{{ url('DeleteAllReq') }}"><i class="fas fa-trash-alt fa-lg"></i>&nbsp; Delete Selected Data</button>
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
              <td>Keterangan</td>
              <td>Status</td>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($req as $data)
              <tr>
                <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <object data="{{$data['file']}}" type="application/pdf" width="100%" height="100%">
                    <p><a style="text-decoration: none; color:blue" href="/checkFile/{{encrypt($data->id)}}">{{$data->file->file}}</a></p>
                  </object>
                  @if($data->status == 'Waiting')

                    <small style="color:orange">
                      Mengirim Ke {{$data->signer->nama}}
                    </small>
                  @endif

                  @if($data->status == 'Approved')

                    <small style="color:green">
                        Signed By {{$data->signer->nama}}
                    </small>
                  @endif

                  @if ($data->status == 'Decline')
                      <small style="color:red">
                        Declined By {{$data->signer->nama}}
                      </small>
                      <br>
                    <small style="color:black">
                      Keterangan : {{$data->signer_feed->feedback}}
                    </small>
                  @endif
                </td>
                <td>{{$data->created_at}}</td>
                <td>{{$data->keterangan}}</td>
                <td>
                  @if ($data->status == 'Waiting')
                      <b style="background-color: yellow; border-radius:10px">
                        {{$data->status}}
                      </b>
                  @endif
                  @if ($data->status == 'Approved')
                      <b class="text-white" style="background-color: green; border-radius: 10px;">
                        {{$data->status}}
                      </b>
                  @endif
                  @if ($data->status == 'Decline')
                      <b class="text-white" style="background-color: red;  border-radius: 10px;">
                        {{$data->status}}
                      </b>
                  @endif
                </td>
                <td>
                  <form
                    action="{{ route('permintaan.destroy', $data->id) }}"
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
                  @if($data->status == 'Approved')
                  <div class="mt-2">
                    <a
                      href="/certoutReq/{{$data->id}}"
                      type="button"
                      class="btn btn-secondary btn-m btn-circle"
                      ><i class="fas fa-download"></i
                    ></a>
                  </div>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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