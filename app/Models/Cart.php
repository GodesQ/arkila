<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['product_id', 'customer_id', 'vendor_id', 'amount', 'quantity', 'start_date', 'end_date', 'total_date'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }   
    
    public function checkout() {
        return $this->belongsTo(Checkout::class);
    }
    
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}