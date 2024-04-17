<?php

namespace App\Http\Controllers\admin\laporan;

use App\Http\Controllers\Controller;
use App\Models\JenisIyuran;
use App\Models\PembayaranIyuran;
use Illuminate\Http\Request;

class lprPembayaran extends Controller
{
    public function index()
    {
        $jenisIyuran = JenisIyuran::orderBy('id', 'desc')->get();

        return view('admin.dashboard.laporan.pembayaran.index', compact('jenisIyuran'));
    }

    public function jenis($jenisid)
    {
        $jenisIyuran = JenisIyuran::where('id', $jenisid)->first();

        $pembayaran = PembayaranIyuran::where('jenis_iyuran_id', $jenisid)->get();
        // dd($pembayaran);

        return view('admin.dashboard.laporan.pembayaran.jenis', compact('jenisIyuran', 'pembayaran'));
    }
}
