<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_id',
        'date',
        'quantity',
        'vendor',
        'notes',
        'price',
        'total'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
