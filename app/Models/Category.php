<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
   public function genres()
    {
        return $this->hasMany(Genre::class);
    }
    
    public function maintenances()
    {
        return $this->hasMany(maintenance::class);
    }
    
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
    
    public function purchases()
    {
        return $this->hasMany(Purchases::class);
    }
}
