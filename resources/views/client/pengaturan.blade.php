@extends('layouts.app')
@section('title', 'Pengaturan')
@if (Auth::user()->level == "Admin")
  @section('heading', 'Pengaturan')
@endif
@section('styles')
  <style>
    .table {
      margin-bottom: 0;
      color: #000;
    }

    .table td {
      border-top: none;
    }
  </style>
@endsection
@section('content')
  <div class="row justify-content-center">
    @if (Auth::user()->level != "Admin")
    <div class="col-12">
      <a href="javascript:window.history.back();" class="text-dark btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
    @else
    <div class="col-12">
    @endif
      <div class="card shadow">
        <div class="card-body">
          <table class="table">
            <tr>
              <td><i class="fas fa-user"></i></td>
              <td>Ubah Data User</td>
              <td class="text-right">
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#ubah-name"
                >
                  Ubah
                </button>
              </td>
            </tr>
            <tr  style="border-top: 1px solid #e3e6f0;">
              <td><i class="fas fa-key"></i></td>
              <td>Ubah Password</td>
              <td class="text-right">
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#ubah-password"
                >
                  Ubah
                </button>
              </td>
            </tr>
            {{-- @foreach ($pin as $data) --}}
            {{-- @continue($data->status == 1) --}}
           {{-- @if($data->status) --}}
            <tr  style="border-top: 1px solid #e3e6f0;">
              <td><i class="fas fa-key"></i></td>
              <td>Buat Pin</td>
              <td class="text-right">
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#buat-pin"
                >
                  buat
                </button>
              </td>
            </tr>
            {{-- @endif --}}
            {{-- @endforeach --}}

            {{-- <tr  style="border-top: 1px solid #e3e6f0;">
              <td><i class="fas fa-key"></i></td>
              <td>Ubah Pin</td>
              <td class="text-right">
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#buat-pin"
                >
                  ubah
                </button>
              </td>
            </tr> --}}
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Ubah Name Modal -->
  <div
  class="modal fade"
  id="ubah-name"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Nama User</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('edit.name') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama User</label>
              <input
                type="text"
                class="form-control"
                id="nama"
                name="nama"
                value="{{ Auth::user()->nama }}"
                required
                readonly
              />
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                value="{{ Auth::user()->username }}"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Alamat Email</label>
              <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                value="{{ Auth::user()->email }}"
                required
              />
            </div>
            <div class="form-group">
              <label for="bagian">Bagian</label>
              <input
                type="text"
                class="form-control"
                id="bagian"
                name="bagian"
                value="{{ Auth::user()->bagian }}"
                required
                readonly
              />
            </div>
            <div class="form-group">
              <label for="nip">NIP</label>
              <input
                type="text"
                class="form-control"
                id="nip"
                name="nip"
                value="{{ Auth::user()->nip }}"
                required
                readonly
              />
            </div>
            <div class="form-group">
              <label for="telepon">No. Telepon</label>
              <input
                type="text"
                class="form-control"
                id="telepon"
                name="telepon"
                value="{{ Auth::user()->telepon }}"
                required
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Kembali
            </button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Ubah Password Modal -->
  <div
  class="modal fade"
  id="ubah-password"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('edit.password') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="password_lama">Password Lama</label>
              <input id="password_lama" type="password" class="form-control" name="password_lama">
            </div> 
            <div class="form-group">
              <label for="password">Password Baru</label>
              <input id="password" type="password" class="form-control" name="password">
            </div> 
            <div class="form-group">
              <label for="password-confirm">Confirm Password</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Kembali
            </button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- buat Pin Modal -->

   <div
   class="modal fade"
   id="buat-pin"
   tabindex="-1"
   role="dialog"
   aria-labelledby="exampleModalLabel"
   aria-hidden="true"
   >
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Buat Pin</h5>
           <button
             type="button"
             class="close"
             data-dismiss="modal"
             aria-label="Close"
           >
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         
         <form action="{{ route('add.pin') }}" method="POST">
           @csrf
           
           <div class="modal-body">
            
             <div class="form-group">
               <label for="pin">Buat PIN</label>
               <input id="pin" type="text" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control" name="pin" placeholder="Masukkan PIN [minimal 8 Angka]">
             </div> 
           </div>
         

           
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">
               Kembali
             </button>
             <button type="submit" class="btn btn-primary">Buat</button>
           </div>
          
         </form>
       
       </div>
     </div>
   </div>
  
@endsection