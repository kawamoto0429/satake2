<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function genre()
    {
        return $this->hasMany(Genre::class);
    }
}
