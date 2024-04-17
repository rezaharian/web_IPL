@extends('admin.dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Jenis Iyuran</h1>

        <form action="{{ route('admin.masterJenIyuran.update', ['id' => $jeniyuran->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $jeniyuran->nama }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nominal">Nominal:</label>
                <input type="text" class="form-control" id="nominal" name="nominal" value="{{ $jeniyuran->nominal }}"
                    required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $jeniyuran->keterangan }}</textarea>
            </div>

            <!-- Jika diperlukan, Anda bisa menambahkan input untuk atribut lainnya di sini -->

            <button type="submit" class="btn btn-primary">Update Iyuran</button>
        </form>
    </div>
@endsection
