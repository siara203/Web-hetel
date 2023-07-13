<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    protected $table = 'room_details';

    protected $fillable = [
        'room_id',
        'description',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
