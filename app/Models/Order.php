<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    // Melindungi agar tidak ada kolom yang bisa diisi sembarangan,
    // alternatif dari $fillable jika semua kolom aman untuk diisi.
    protected $guarded = [];

    /**
     * Mendefinisikan relasi "belongsTo".
     * Satu Order dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [BARU] Mendefinisikan relasi "hasMany".
     * Satu Order memiliki banyak OrderItem (barang).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}