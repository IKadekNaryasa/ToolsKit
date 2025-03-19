<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;
    protected $table = 'repairs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tool_code',
        'repair_date',
        'done_date',
        'description',
        'status',
        'cost'
    ];

    public function tool()
    {
        return $this->belongsTo(MntTool::class, 'tool_code');
    }
}
