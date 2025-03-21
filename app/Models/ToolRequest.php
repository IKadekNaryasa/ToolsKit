<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ToolRequest extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $primaryKey = 'request_code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'request_code',
        'user_id',
        'status',
        'request_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasMany(RequestDetail::class, 'request_code');
    }
}
