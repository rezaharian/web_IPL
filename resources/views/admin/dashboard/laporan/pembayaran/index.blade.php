@extends('admin.dashboard.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pembayaran</h1>

        <!-- Card -->
        <style>
            .card:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transform: translateY(-5px);
                transition: box-shadow 0.3s, transform 0.3s;
            }
        </style>

        <div class="row">
            @foreach ($jenisIyuran as $jns)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('admin.laporan.pembayaran.jenis', ['jenisid' => $jns->id]) }}"
                        style="text-decoration: none;">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><strong>{{ $jns->nama }}</strong></h5>
                                <p class="card-text"><strong>Nominal:</strong> {{ $jns->nominal }}</p>
                                <p class="card-text"><strong>Keterangan:</strong> {{ $jns->keterangan }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


    </div>
@endsection
