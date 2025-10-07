<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'status',
        'deskripsi',
        'gambar'
    ];

    public function Orders(): HasMany{
        return $this->hasMany(Order::class);
    }
};
