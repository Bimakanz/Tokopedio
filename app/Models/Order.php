<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =   [
        'produk_id',
        'user_id',
        'nama_pemesan',
        'alamat',
        'jumlah',
        'kurir',
        'metode',
        'status',
        'total_harga'
    ];
    // relasi model ke user
    

    public function user()  {
        return $this->belongsTo(User::class);
        
    }

    public function produk() {
        return $this->belongsTo(Produk::class);
    
}

}
