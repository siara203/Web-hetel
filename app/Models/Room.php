<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'size', 'price', 'type_id', 'status','description','picture_id',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function orders()
    {
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
    
}

