<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_user_login extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'login_time'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
