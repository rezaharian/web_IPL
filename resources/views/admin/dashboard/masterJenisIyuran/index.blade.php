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
    <h1 class="h3 mb-2 text-gray-800">Tables Users</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.masterJenIyuran.create') }}" class="btn btn-sm btn-primary" role="button">
                Tambah
            </a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt['id'] }}</td>
                                <td>{{ $dt['nama'] }}</td>
                                <td>{{ $dt['nominal'] }}</td>
                                <td>{{ $dt['keterangan'] }}</td>
                                <td>{{ $dt['created_at'] }}</td>
                                <td>
                                    <a href="{{ route('admin.masterJenIyuran.edit', ['id' => $dt->id]) }}"
                                        class="btn btn-sm m-0 btn-primary">E</a>
                                    <form action="{{ route('admin.masterJenIyuran.destroy', ['id' => $dt->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm m-0"
                                            onclick="return confirm('Are you sure you want to delete this user?')">D</button>
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
