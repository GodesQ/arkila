<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'product_image', 'stock', 'category_id', 'vendor_id', 'amount', 'description'];

    protected $appends = [
        'rate' => 'integer',
        'total_reviews' => 'integer'
    ];

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

    public function getRateAttribute()
    {
        return $this->rate();
    }

    public function getTotalReviewsAttribute() {
        return $this->total_reviews();
    }

    public function rate() {
        #sum of all rates
        $sum_rate = ProductReview::where('product_id', $this->id)->sum('rate');

        # total of reviews
        $total_of_reviews = $this->total_reviews();

        $average = $sum_rate == 0 ? 0 : $sum_rate / $total_of_reviews;

        $total_average = number_format($average, 1);
        return (float) number_format($total_average, 1);
    }

    public function total_reviews() {
        $total_of_reviews = ProductReview::where('product_id', $this->id)->count();
        return $total_of_reviews;
    }
}
