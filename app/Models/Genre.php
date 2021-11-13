<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // protected $fillable = [
    //     'category_id',
    //     '',
    // ];
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
    
    public function maintenances()
    {
        return $this->hasMany(maintenance::class);
    }
}
