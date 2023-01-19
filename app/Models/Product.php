<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'product_image', 'stock', 'category_id', 'vendor_id', 'amount', 'description'];

    public function carts() {
        return $this->belongsTo(Cart::class);
    }

    public function checkout() {
        return $this->belongsTo(Checkout::class);
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
    
    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}