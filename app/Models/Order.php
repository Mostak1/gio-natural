<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'billing_address',
        'shipping_address',
        'phone',
        'message',
        'subtotal',
    ];
}
