<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaMobil extends Model {
    use HasFactory;
    protected $table = 'sewa_mobil';
    protected $fillable = ['user_id', 'mobil_id', 'tanggal_sewa', 'tanggal_kembali', 'total_harga', 'status_pembayaran'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function mobil() {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}