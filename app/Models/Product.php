<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->id = (string) Str::uuid();
        });
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}