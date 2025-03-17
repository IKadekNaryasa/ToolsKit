<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ToolRequest extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $primaryKey = 'request_code';
    protected $fillable = [
        'request_code',
        'user_id',
        'status',
        'tanggal_request',
    ];
}
