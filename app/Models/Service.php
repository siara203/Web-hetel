<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'price', 'description','image'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_services')->withTimestamps();
    }
}
