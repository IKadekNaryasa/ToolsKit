<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Returns extends Model
{
    use HasFactory;
    protected $table = 'returns';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'borrowing_code',
        'return_date',
        'notes',
        'admin_id',
        'status'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrowing_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
