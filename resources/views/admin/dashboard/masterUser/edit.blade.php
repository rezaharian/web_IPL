@extends('admin.dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

        <form action="{{ route('admin.masteruser.update', ['encryptedId' => Crypt::encryptString($duser->user->id)]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $duser->user->name }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $duser->user->email }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Full Name:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                    value="{{ $duser->nama_lengkap }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Address:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $duser->alamat }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nomor_rumah">House Number:</label>
                <input type="text" class="form-control" id="nomor_rumah" name="nomor_rumah"
                    value="{{ $duser->nomor_rumah }}" required>
            </div>

            <div class="form-group">
                <label for="blok">Block:</label>
                <input type="text" class="form-control" id="blok" name="blok" value="{{ $duser->blok }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Phone Number:</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                    value="{{ $duser->nomor_telepon }}">
            </div>

            <div class="form-group">
                <label for="pekerjaan">Occupation:</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $duser->pekerjaan }}">
            </div>

            <div class="form-group">
                <label for="status_perkawinan">Marital Status:</label>
                <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan"
                    value="{{ $duser->status_perkawinan }}">
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection
