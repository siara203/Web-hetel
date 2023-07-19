<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'check_in_date', 'check_out_date', 'status', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'order_rooms', 'order_id', 'room_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_services', 'order_id', 'service_id')
                    ->withPivot('quantity');
    }

    public function orderRooms()
    {
        return $this->hasMany(OrderRoom::class);
    }

    
    public function orderServices()
    {
        return $this->hasMany(OrderServices::class);
    }
    
    public function getTotalHours()
    {
        $checkInDate = Carbon::parse($this->check_in_date);
        $checkOutDate = Carbon::parse($this->check_out_date);

        return $checkInDate->diffInHours($checkOutDate);
    }

    public function getTotalServiceAmount()
    {
        $totalAmount = 0;

        foreach ($this->orderServices as $orderService) {
            $service = $orderService->service;
            $quantity = $orderService->quantity;
            $totalAmount += $service->price * $quantity;
        }

        return $totalAmount;
    }

    public function getServiceQuantity($serviceId)
    {
        $orderService = $this->orderServices()->where('service_id', $serviceId)->first();
        if ($orderService) {
            return $orderService->quantity;
        }
        return 0;
    }

}
