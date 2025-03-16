<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestDetail extends Model
{
    use HasFactory;
    protected $table = 'request_details';
    protected $primaryKey = 'request_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'request_code',
        'category_id',
    ];
}
