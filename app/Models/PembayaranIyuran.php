<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIyuran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_iyurans';
    protected $fillable = ['user_id', 'jenis_iyuran_id', 'tanggal_pembayaran', 'keterangan'];

    // hubungan dengan JenisIyuran
    public function jenisIyuran()
    {
        return $this->belongsTo(JenisIyuran::class, 'jenis_iyuran_id');
    }

    // Definisi relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
