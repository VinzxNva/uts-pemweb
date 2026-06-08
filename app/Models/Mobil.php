<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model {
    use HasFactory;
    protected $table = 'mobil';
    protected $fillable = ['nama_mobil', 'merek', 'plat_nomor', 'harga_per_hari', 'status'];
}