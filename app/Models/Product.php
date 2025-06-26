<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id', 
        'slug',        
    ];

    /**
     * Mendefinisikan relasi ke Category.
     * Satu Produk dimiliki oleh satu Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}