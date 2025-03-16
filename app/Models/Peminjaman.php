<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_code';
    protected $fillable = [
        'peminjaman_code',
        'user_id',
        'tanggal_peminjaman',
        'tanggal_kembali',
        'keterangan',
        'status',
        'by_admin'
    ];
}
