<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cireng extends Model
{
    protected $fillable = ['nama_menu', 'harga', 'stok', 'kategori', 'deskripsi', 'link_wa', 'link_img'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

