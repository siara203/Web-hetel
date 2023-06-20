<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{   
    protected $fillable = ['file_name', 'path', 'gfi'];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

