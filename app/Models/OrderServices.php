<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderServices extends Model
{
    protected $table = 'order_services';

    protected $fillable = [
        'order_id',
        'service_id',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}
