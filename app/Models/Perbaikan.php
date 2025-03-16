<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = 'perbaikan';
    protected $primaryKey = 'perbaikan_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_alat',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'description',
        'status',
        'biaya'
    ];
}
