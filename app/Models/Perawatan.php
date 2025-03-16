<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perawatan extends Model
{
    use HasFactory;

    protected $table = 'perawatan';
    protected $primaryKey = 'perawatan_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_alat',
        'tanggal_perawatan',
        'tanggal_selesai',
        'description',
        'status',
        'biaya',
    ];
}
