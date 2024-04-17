@extends('admin.dashboard.layouts.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables Pembayaran Iyuran</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.masterPembayaranIyuran.create') }}" class="btn btn-sm btn-primary" role="button">
                Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama </th>
                            <th>Jenis Iyuran </th>
                            <th>Tanggal Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->id }}</td>
                                <td>{{ $dt->user->detailUser->nama_lengkap }}</td>
                                <td>{{ $dt->jenisIyuran->nama }}</td>
                                <td>{{ $dt->tanggal_pembayaran }}</td>
                                <td>{{ $dt->keterangan }}</td>
                                <td>
                                    <a href="{{ route('admin.masterPembayaranIyuran.edit', ['id' => $dt['id']]) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.masterPembayaranIyuran.destroy', ['id' => $dt['id']]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
