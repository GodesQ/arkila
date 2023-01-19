<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionToken extends Model
{
    use HasFactory;
    protected $fillable = ['token']; 
    protected $table = 'session_token'; 
}