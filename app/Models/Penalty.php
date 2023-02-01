<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    protected $table = 'penalty';
    protected $guarded = [];

    public function checkout() {
        return $this->hasOne(Checkout::class, 'id', 'checkout_id');
    }
}
