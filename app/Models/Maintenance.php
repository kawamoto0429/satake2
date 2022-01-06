<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price_1pc', 'price_10pcs',
        'price_30pcs', 'jan', 'maker_id',
        'maker_name','category_id','category_name',
        'genre_id', 'genre_name', 'lot',
        'tomorrow_flg', 'nodisplay_flg', 'new_flg',
        'imgpath',
    ];
    
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
        return $this->belongsTo(Genre::class);
    }
    
    public function purchases() 
    {
        return $this->hasMany(Purchase::class);
    }
}
