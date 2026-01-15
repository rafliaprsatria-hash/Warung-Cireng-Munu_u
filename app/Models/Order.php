<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'cireng_id',
        'nama_produk',
        'quantity',
        'total_harga',
        'status',
        'nomor_wa'
    ];

    public function cireng()
    {
        return $this->belongsTo(Cireng::class);
    }
}
