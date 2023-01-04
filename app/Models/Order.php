<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'tracking_no',
        'name',
        'email',
        'phone',
        'address',
        'country',
        'city',
        'state',
        'zip',
        'status',
        'status_message',
        'payment_mode',
        'payment_id',
        'shipping_different',
        'different_name',
        'different_email',
        'different_phone',
        'different_address',
        'different_country',
        'different_city',
        'different_state',
        'different_zip'
    ];
}
