<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // 🔗 Relasi ke OrderAdd commentMore actions
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 🔗 Relasi ke Product


        public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
