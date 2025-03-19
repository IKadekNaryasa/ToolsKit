<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'quantity'
    ];

    public function tools()
    {
        return $this->hasMany(MntTool::class, 'category_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id');
    }

    public function requestDetails()
    {
        return $this->hasMany(RequestDetail::class, 'category_id');
    }
}
