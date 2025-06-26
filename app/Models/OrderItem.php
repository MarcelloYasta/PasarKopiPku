<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi: Satu OrderItem dimiliki oleh satu Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}