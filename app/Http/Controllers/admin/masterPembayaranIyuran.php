<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JenisIyuran;
use App\Models\PembayaranIyuran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class masterPembayaranIyuran extends Controller
{
    public function index()
    {
        $data = PembayaranIyuran::get();
        // dd($data->toArray());




        return view('admin.dashboard.masterPembayaranIyuran.index', compact('data'));
    }
    public function create()
    {
        $user = User::get();
        $jenisIyuran = JenisIyuran::get();
        // dd($user);

        return view('admin.dashboard.masterPembayaranIyuran.create', compact('user', 'jenisIyuran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jenis_iyuran_id' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil tahun dari tanggal_pembayaran
        $tahun_pembayaran = Carbon::parse($request->input('tanggal_pembayaran'))->year;

        // Periksa apakah sudah ada entri dalam database yang memiliki jenis_iyuran_id yang sama untuk user yang sama pada tahun yang sama
        $existingPayment = PembayaranIyuran::where('user_id', $request->input('user_id'))
            ->where('jenis_iyuran_id', $request->input('jenis_iyuran_id'))
            ->whereYear('tanggal_pembayaran', $tahun_pembayaran)
            ->exists();

        // Ambil nama pengguna dari model User
        $user = User::findOrFail($request->input('user_id'));
        $namaPengguna = $user->detailUser->nama_lengkap; // Anda harus menyesuaikan dengan kolom yang tepat yang menyimpan nama pengguna di model User Anda.

        // Jika sudah ada pembayaran yang ada, berikan pesan kesalahan
        if ($existingPayment) {
            $jenisIyuran = JenisIyuran::findOrFail($request->input('jenis_iyuran_id'));
            $namaJenisIyuran = $jenisIyuran->nama; // Anda harus memiliki kolom 'nama' pada tabel JenisIyuran atau sesuaikan dengan nama kolom yang sesuai.

            return redirect()->back()->withInput()->withErrors(['jenis_iyuran_id' => "$namaPengguna sudah melakukan pembayaran untuk jenis $namaJenisIyuran pada tahun yang sama."]);
        }

        // Buat objek PembayaranIyuran baru dan isi dengan data yang diterima dari formulir
        $pembayaranIyuran = new PembayaranIyuran();
        $pembayaranIyuran->user_id = $request->input('user_id');
        $pembayaranIyuran->jenis_iyuran_id = $request->input('jenis_iyuran_id');
        $pembayaranIyuran->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $pembayaranIyuran->keterangan = $request->input('keterangan');

        // Simpan data ke dalam database
        $pembayaranIyuran->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.masterPembayaranIyuran.index')->with('success', 'Pembayaran Iyuran berhasil disimpan!');
    }
    public function edit($id)
    {
        // Retrieve the pembayaran iyuran based on the provided $id
        $pembayaranIyuran = PembayaranIyuran::findOrFail($id);

        // Retrieve all users and jenis iyuran
        $user = User::all();
        $jenisIyuran = JenisIyuran::all();

        // Pass the pembayaran iyuran data along with user and jenis iyuran to the view
        return view('admin.dashboard.masterPembayaranIyuran.edit', [
            'pembayaranIyuran' => $pembayaranIyuran,
            'user' => $user,
            'jenisIyuran' => $jenisIyuran,
        ]);
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'jenis_iyuran_id' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil tahun dari tanggal_pembayaran
        $tahun_pembayaran = Carbon::parse($request->input('tanggal_pembayaran'))->year;

        // Periksa apakah sudah ada entri dalam database yang memiliki jenis_iyuran_id yang sama untuk user yang sama pada tahun yang sama, kecuali entri yang akan diupdate
        $existingPayment = PembayaranIyuran::where('user_id', $request->input('user_id'))
            ->where('jenis_iyuran_id', $request->input('jenis_iyuran_id'))
            ->whereYear('tanggal_pembayaran', $tahun_pembayaran)
            ->where('id', '!=', $id) // Exclude the current record being updated
            ->exists();

        // Jika sudah ada pembayaran yang ada, berikan pesan kesalahan
        if ($existingPayment) {
            return redirect()->back()->withInput()->withErrors(['jenis_iyuran_id' => 'Anda sudah melakukan pembayaran untuk jenis ini pada tahun yang sama.']);
        }

        // Cari pembayaran iyuran yang akan diupdate
        $pembayaranIyuran = PembayaranIyuran::findOrFail($id);

        // Update data dengan data baru
        $pembayaranIyuran->user_id = $request->input('user_id');
        $pembayaranIyuran->jenis_iyuran_id = $request->input('jenis_iyuran_id');
        $pembayaranIyuran->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $pembayaranIyuran->keterangan = $request->input('keterangan');

        // Simpan perubahan
        $pembayaranIyuran->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.masterPembayaranIyuran.index')->with('success', 'Pembayaran Iyuran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Temukan pembayaran iyuran yang akan dihapus
        $pembayaranIyuran = PembayaranIyuran::findOrFail($id);

        // Hapus entri dari database
        $pembayaranIyuran->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.masterPembayaranIyuran.index')->with('success', 'Pembayaran Iyuran berhasil dihapus!');
    }
}
