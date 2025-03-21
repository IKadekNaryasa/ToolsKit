<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;
    protected $table = 'tools';
    protected $primaryKey = 'tool_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tool_code',
        'name',
        'condition',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowing()
    {
        return $this->hasMany(BorrowingDetail::class, 'tool_code');
    }

    public function repair()
    {
        return $this->hasMany(Repair::class, 'tool_code');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'tool_code');
    }
}
