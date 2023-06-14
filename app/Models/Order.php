<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'payment_id',
        'service_id',
    ];

    // Define the relationships with other models
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
