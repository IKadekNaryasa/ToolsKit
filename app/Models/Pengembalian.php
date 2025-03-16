<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $primaryKey = 'pengembalian_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'peminjaman_code',
        'tanggal_kembali',
        'keterangan',
        'user_id',
        'status'
    ];
}
