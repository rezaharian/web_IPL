@extends('admin.dashboard.layouts.master')


@section('content')
    <h1>User Profile</h1>

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <!-- Menampilkan detail user terkait jika ada -->
    @if ($user->detailUser)
        <p><strong>Nama Lengkap:</strong> {{ $user->detailUser->nama_lengkap }}</p>
        <p><strong>Alamat:</strong> {{ $user->detailUser->alamat }}</p>
        <!-- Menampilkan kolom lainnya sesuai kebutuhan -->
    @endif

    <!-- Menampilkan status user atau admin -->
    <p><strong>Status:</strong> {{ $user->role_id == 1 ? 'Admin' : 'User' }}</p>
@endsection
