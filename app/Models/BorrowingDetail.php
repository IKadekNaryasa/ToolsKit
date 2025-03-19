<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowingDetail extends Model
{
    use HasFactory;
    protected $table = 'borrowing_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'borrowing_code',
        'tool_code',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrowing_code');
    }

    public function tool()
    {
        return $this->belongsTo(MntTool::class, 'tool_code');
    }
}
