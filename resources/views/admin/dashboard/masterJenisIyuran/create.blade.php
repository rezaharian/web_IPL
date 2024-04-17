@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row card p-2">
        <div class="col-lg-12">
            <div class="p-1">
                <div class="text-center">
                </div>
                <form class="user" action="{{ route('admin.masterJenIyuran.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control form-control-md" id="nama" name="nama"
                                value="{{ old('nama') }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="nominal">Nominal:</label>
                            <input type="text" class="form-control form-control-md" id="nominal" name="nominal"
                                value="{{ old('nominal') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <input type="text" class="form-control form-control-md" id="keterangan" name="keterangan"
                            value="{{ old('keterangan') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
