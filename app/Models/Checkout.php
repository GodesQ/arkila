<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkout';
    protected $fillable = ['firstname', 'lastname', 'address', 'zip_code', 'email', 'contactno', 'quantity', 'payment_type', 'total', 'status', 'isVendorRate', 'cart_id', 'vendor_id', 'txnid', 'product_id', 'customer_id', 'start_date', 'end_date', 'isCancel', 'total_date'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vendor() {
        return $this->hasOne(Vendor::Class, 'id', 'vendor_id');
    }

    public function product() {
        return $this->hasOne(Product::Class, 'id', 'product_id');
    }

    public function cart() {
        return $this->hasOne(Cart::Class, 'id', 'cart_id');
    }

    public function IsAvailableExtensionDate() {
        $checkout = Checkout::where('id', $this->id)->first();
        if($checkout) {
            $checkouts = Checkout::where('product_id', $this->product_id)->get();
            $checkoutStartDates = [];
            foreach ($checkouts as $key => $checkout) {
                $date = Carbon::create($checkout->start_date);
                array_push($checkoutStartDates, $date);
            }
            $checkoutEndDate = Carbon::create($checkout->end_date)->addDays(1);
            return !in_array($checkoutEndDate, $checkoutStartDates) ? true : false;
        }
    }
}
