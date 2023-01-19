<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';
    protected $fillable = ['product_id', 'customer_id', 'review', 'review_image', 'rate'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}