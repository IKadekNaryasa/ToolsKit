<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_details';
    protected $primaryKey = 'peminjaman_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'peminjaman_code',
        'kode_alat',
    ];
}
