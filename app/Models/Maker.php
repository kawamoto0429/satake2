<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }
    
    public function maintenances()
    {
        return $this->hasMany(maintenance::class);
    }
}
