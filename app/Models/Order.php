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
    ];
}
