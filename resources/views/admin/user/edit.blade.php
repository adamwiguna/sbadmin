@extends('layouts.app')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Halaman Edit User</h1>
<p class="mb-4">
    Di halaman ini anda dapat mengubah data User
</p>

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Form User Baru
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.user.update',  $user) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="form-group">
                <label for="exampleInputEmail1" class=" text-dark">NIP /  Username</label>
                <input type="text" class="form-control  @error('username') is-invalid  @enderror" placeholder="Masukkan NIP/Username" name="username" value="{{ old('username', $user->email) }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class=" text-dark">Password</label>
                <input type="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Masukkan Password" name="password" >
            </div>
            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid  @enderror" id="confirmation_password" placeholder="Konfirmasi Password" name="password_confirmation" >
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
  
            <div class="form-group">
                <label for="exampleInputPassword1" class=" text-dark">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid  @enderror" placeholder="Masukkan Nama Anda" name="nama" value="{{ old('name', $user->name) }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class=" text-dark">OPD</label>
                <select class="form-control @error('opd') is-invalid  @enderror" id="exampleFormControlSelect1" name="opd">
                    <option aria-readonly="true" disabled selected>Pilih OPD</option>
                    @foreach ($dataOpd as $opd)
                        <option value="{{ $opd->id }}" {{ $user->division_id==$opd->id?'selected':'' }}>{{ $opd->nama }}</option>     
                    @endforeach
                </select>
                @error('opd')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class=" text-dark">Jabatan</label>
                <input type="text" class="form-control @error('jabatan') is-invalid  @enderror" placeholder="Masukkan Jabatan" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}">
                @error('jabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class=" text-dark">Singkatan Nama Jabatan</label>
                <input type="text" class="form-control @error('singkatanJabatan') is-invalid  @enderror" placeholder="Masukkan Singkatan Nama Jabatan" name="singkatanJabatan" value="{{ old('jabatan_singkatan', $user->jabatan_singkatan) }}">
                @error('singkatanJabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>



@endsection