<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIyuran extends Model
{
    use HasFactory;
    protected $table = 'jenis_iyurans';
    protected $fillable = ['nama', 'nominal', 'keterangan'];

    // hubungan dengan PembayaranIyuran
    public function pembayaranIyuran()
    {
        return $this->hasMany(PembayaranIyuran::class);
    }
}
