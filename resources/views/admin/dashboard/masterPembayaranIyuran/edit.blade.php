@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row card p-2">
        <div class="col-lg-12">
            <div class="p-1">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Pembayaran Iyuran</h1>
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
                <form class="user"
                    action="{{ route('admin.masterPembayaranIyuran.update', ['id' => $pembayaranIyuran->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label for="user_id">User:</label>
                            <select class="form-control form-control-md" id="user_id" name="user_id" required>
                                <option value="" selected disabled>Pilih User</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}"
                                        {{ $u->id == $pembayaranIyuran->user_id ? 'selected' : '' }}>
                                        {{ $u->detailUser->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="jenis_iyuran_id">Jenis Iyuran:</label>
                            <select class="form-control form-control-md" id="jenis_iyuran_id" name="jenis_iyuran_id"
                                required>
                                <option value="" selected disabled>Pilih Jenis Iyuran</option>
                                @foreach ($jenisIyuran as $iyuran)
                                    <option value="{{ $iyuran->id }}"
                                        {{ $iyuran->id == $pembayaranIyuran->jenis_iyuran_id ? 'selected' : '' }}>
                                        {{ $iyuran->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                            <input type="date" class="form-control form-control-md" id="tanggal_pembayaran"
                                name="tanggal_pembayaran"
                                value="{{ old('tanggal_pembayaran', $pembayaranIyuran->tanggal_pembayaran) }}" required>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="keterangan">Keterangan:</label>
                            <input type="text" class="form-control form-control-md" id="keterangan" name="keterangan"
                                value="{{ old('keterangan', $pembayaranIyuran->keterangan) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
