<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorReview extends Model
{
    use HasFactory;
    protected $table = 'vendor_reviews';
    protected  $fillable = ['vendor_id', 'customer_id', 'product_id', 'review', 'rate'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}