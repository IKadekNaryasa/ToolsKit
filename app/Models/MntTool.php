<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MntTool extends Model
{
    use HasFactory;
    protected $table = 'mnt_tools';
    protected $primaryKey = 'kode_alat';
    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kondisi',
        'status',
        'category_id',
    ];
}
