<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
    
    public function genre()
    {
        return $this->belongsTo(genre::class);
    }
}
