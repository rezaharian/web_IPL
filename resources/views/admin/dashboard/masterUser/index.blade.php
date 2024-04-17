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
            <a href="{{ route('admin.masteruser.create') }}" class="btn btn-sm btn-primary" role="button">
                Tambah
            </a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Nomor Rumah</th>
                            <th>Blok</th>
                            <th>Nomor Telepon</th>
                            <th>Pekerjaan</th>
                            <th>Status Perkawinan</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['nama_lengkap'] }}</td>
                                <td>{{ $user['alamat'] }}</td>
                                <td>{{ $user['nomor_rumah'] }}</td>
                                <td>{{ $user['blok'] }}</td>
                                <td>{{ $user['nomor_telepon'] }}</td>
                                <td>{{ $user['pekerjaan'] }}</td>
                                <td>{{ $user['status_perkawinan'] }}</td>
                                <td>
                                    <a href="{{ route('admin.masteruser.edit', ['encryptedId' => substr(hash('sha256', $user->id), 0, 6)]) }}"
                                        class="btn btn-sm m-0 btn-primary">E</a>

                                    <form action="{{ route('admin.masteruser.destroy', ['encryptedId' => $user->id]) }}"
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
