<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\detail_user;
use App\Models\JenisIyuran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class masterJenIyuranController extends Controller
{
    public function index()
    {
        $data = JenisIyuran::get();
        // dd($data->toArray());


        return view('admin.dashboard.masterJenisIyuran.index', compact('data'));
    }
    public function create()
    {

        return view('admin.dashboard.masterJenisIyuran.create');
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data ke dalam database
        $masterJenIyuran = new JenisIyuran();
        $masterJenIyuran->nama = $request->nama;
        $masterJenIyuran->nominal = $request->nominal;
        $masterJenIyuran->keterangan = $request->keterangan;

        // Tambahkan logika lain untuk menyimpan data sesuai kebutuhan Anda

        $masterJenIyuran->save();

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('admin.masterJenIyuran.index')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        // Retrieve the user based on the provided $id
        $jeniyuran = JenisIyuran::find($id);

        // Perform any necessary logic for editing (e.g., fetching related data)

        // Pass the user data to the view

        // dd($jeniyuran);
        return view('admin.dashboard.masterJenisIyuran.edit', ['jeniyuran' => $jeniyuran]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama' => 'required|string',
            'nominal' => 'required|numeric',
            'keterangan' => 'required|string',
            // Anda bisa menambahkan validasi tambahan sesuai kebutuhan
        ]);

        // Temukan jenis iyuran berdasarkan ID yang diberikan
        $jeniyuran = JenisIyuran::findOrFail($id);

        // Perbarui atribut-atribut jenis iyuran dengan data yang diterima dari formulir
        $jeniyuran->nama = $request->input('nama');
        $jeniyuran->nominal = $request->input('nominal');
        $jeniyuran->keterangan = $request->input('keterangan');
        // Perbarui atribut lainnya sesuai kebutuhan

        // Simpan perubahan
        $jeniyuran->save();

        // Redirect kembali dengan pesan kesuksesan
        return redirect()->route('admin.masterJenIyuran.index')->with('success', 'Jenis Iyuran berhasil diperbarui!');
    }
    public function destroy($id)
    {
        // Temukan jenis iyuran berdasarkan ID yang diberikan
        $jeniyuran = JenisIyuran::find($id);

        // Periksa apakah jenis iyuran ditemukan
        if (!$jeniyuran) {
            // Jika tidak ditemukan, redirect kembali dengan pesan error
            return redirect()->route('admin.masterJenIyuran.index')->with('error', 'Jenis Iyuran tidak ditemukan!');
        }

        // Hapus jenis iyuran
        $jeniyuran->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.masterJenIyuran.index')->with('success', 'Jenis Iyuran berhasil dihapus!');
    }
}
