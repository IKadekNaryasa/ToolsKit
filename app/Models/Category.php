<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function tools()
    {
        return $this->hasMany(Tool::class, 'category_id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'category_id');
    }

    public function request()
    {
        return $this->hasMany(RequestDetail::class, 'category_id');
    }
}
