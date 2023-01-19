<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customer';
    protected $fillable = ['customer_image', 'address', 'username', 'email', 'password', 'firstname', 'lastname', 'middlename', 'password', 'isVerify', 'contact_no'];

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function checkout() {
        return $this->hasMany(Checkout::class);
    }

    public function confirmed_checkouts() {
        return $this->checkout()->where('status', '=', 'DELIVERED')->orWhere('status', 'RETURNED')->orWhere('status', 'RATED');
    }

    public function reviews() {
        return $this->belongsTo(ProductReview::class);
    }

    public function customer_reviews() {
        return $this->hasMany(CustomerReview::class);
    }
}