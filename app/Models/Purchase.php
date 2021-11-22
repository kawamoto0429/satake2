<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
}
