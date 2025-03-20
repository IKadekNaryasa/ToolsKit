<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tool_code',
        'maintenance_date',
        'done_date',
        'description',
        'status',
        'cost'
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_code');
    }
}
