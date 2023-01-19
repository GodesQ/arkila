<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    
    protected $table = 'vendor';
    protected $fillable = ['vendor_image', 'address', 'username', 'email', 'firstname', 'lastname', 'middlename', 'password', 'isVerify', 'vendor_description', 'contactno'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function checkout() {
        return $this->belongsTo(Checkout::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function customer_reviews() {
        return $this->hasMany(CustomerReview::class);
    }
    
    public function carts() {
        return $this->hasMany(Cart::class);
    }
}