<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrowing extends Model
{
    use HasFactory;
    protected $table = 'borrowings';
    protected $primaryKey = 'borrowing_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'borrowing_code',
        'user_id',
        'borrow_date',
        'return_date',
        'notes',
        'status',
        'admin_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function detail()
    {
        return $this->hasMany(BorrowingDetail::class, 'borrowing_code');
    }

    public function return()
    {
        return $this->hasOne(Returns::class, 'borrowing_code');
    }
}
