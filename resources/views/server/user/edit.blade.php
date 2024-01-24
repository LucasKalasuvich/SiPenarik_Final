@extends('layouts.app')
@section('title', 'Edit User')
@section('heading', 'Edit User')
@section('styles')
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
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
  <div class="card shadow mb-4 mt-2">
    <form action="{{ route('user.store') }}" method="POST">
      @csrf
      <div class="card-body">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input
            type="text"
            class="form-control"
            id="nama"
            name="nama"
            value="{{ $user->nama }}"
            required
          />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            value="{{ $user->username }}"
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
            value="{{ $user->email }}"
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
            value="{{ $user->bagian }}"
            required
          />
        </div>
        <div class="form-group">
          <label for="nip">NIP</label>
          <input
            type="text"
            class="form-control"
            id="nip"
            name="nip"
            value="{{ $user->nip }}"
            required
          />
        </div>
        <div class="form-group">
          <label for="telepon">No. Telepon</label>
          <input
            type="text"
            class="form-control"
            id="telepon"
            name="telepon"
            value="{{ $user->telepon }}"
            required
          />
        </div>
        <div class="form-group">
          <label for="level">Level User</label>
          <select
            class="select2 form-control"
            id="level"
            name="level"
            required
            style="width: 100%; color: #6e707e;"
          >
            {{-- <option value="" disabled selected>-- Pilih Level User --</option> --}}
            <option value="{{old('level', $user->level) }}">{{ $user->level }}</option>
            <option value="Admin">Admin</option>
            {{-- <option value="Petugas">Petugas</option> --}}
            <option value="Users">Users</option>
          </select>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
            required
          />
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Confirm Password"
            required
          />
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('user.index') }}" class="btn btn-warning mr-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
@endsection
{{-- @section('script')
  <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
    if(jQuery().select2) {
      $(".select2").select2();
    }
    function inputNumber(e) {
      const charCode = (e.which) ? e.which : w.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    };
  </script>
@endsection --}}
