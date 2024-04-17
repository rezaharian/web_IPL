@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row card p-2">
        <div class="col-lg-12">
            <div class="p-1">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Pembayaran Iyuran</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form class="user" action="{{ route('admin.masterPembayaranIyuran.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label for="user_id">User:</label>
                            <select class="form-control form-control-md" id="user_id" name="user_id" required>
                                <option value="" selected disabled>Pilih User</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->detailUser->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="jenis_iyuran_id">Jenis Iyuran:</label>
                            <select class="form-control form-control-md" id="jenis_iyuran_id" name="jenis_iyuran_id"
                                required>
                                <option value="" selected disabled>Pilih Jenis Iyuran</option>
                                @foreach ($jenisIyuran as $iyuran)
                                    <option value="{{ $iyuran->id }}">{{ $iyuran->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                            <input type="date" class="form-control form-control-md" id="tanggal_pembayaran"
                                name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran') ?? date('Y-m-d') }}" required>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="keterangan">Keterangan:</label>
                            <input type="text" class="form-control form-control-md" id="keterangan" name="keterangan"
                                value="{{ old('keterangan') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
