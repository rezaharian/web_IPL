@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row card p-2">
        <div class="col-lg-12">
            <div class="p-1">
                <div class="text-center">
                </div>
                <form class="user" action="{{ route('admin.masteruser.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="name" name="name"
                                placeholder="Name" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="nama_lengkap" name="nama_lengkap"
                                placeholder="Full Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <input type="email" class="form-control form-control-md" id="email" name="email"
                                placeholder="Email Address" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="alamat" name="alamat"
                                placeholder="Address" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="nomor_rumah" name="nomor_rumah"
                                placeholder="House Number" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="blok" name="blok"
                                placeholder="Block" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="nomor_telepon"
                                name="nomor_telepon" placeholder="Phone Number" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-md" id="pekerjaan" name="pekerjaan"
                                placeholder="Occupation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-md" id="status_perkawinan"
                            name="status_perkawinan" placeholder="Marital Status" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
