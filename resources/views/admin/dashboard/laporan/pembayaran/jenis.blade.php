@extends('admin.dashboard.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Detail Pembayaran Iyuran</h1>

        <!-- Informasi Jenis Iyuran -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Jenis Iyuran</h6>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $jenisIyuran->nama }}</p>
                <p><strong>Nominal:</strong> {{ $jenisIyuran->nominal }}</p>
                <p><strong>Keterangan:</strong> {{ $jenisIyuran->keterangan }}</p>
            </div>
        </div>

        <!-- Tabel Detail Pembayaran -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Keterangan</th>
                                <th>Dibuat pada</th>
                                <th>Diperbarui pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->detailUser->nama_lengkap }}</td>
                                    <td>{{ $item->tanggal_pembayaran }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
