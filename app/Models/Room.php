<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
        'name', 'size', 'price', 'type_id', 'status', 'description', 'picture_id', 'image2', 'image3', 'image4', 'image5',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_rooms', 'room_id', 'order_id');
        return $this->hasMany(Order::class);
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    public function orderRooms()
{
    return $this->hasMany(OrderRoom::class);
}

}
