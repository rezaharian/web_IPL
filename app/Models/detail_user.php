<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat',
        'nomor_rumah',
        'blok',
        'nomor_telepon',
        'pekerjaan',
        'status_perkawinan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
