<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

// RELACION UNO A MUCHOS
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public $timestamps = false;
}
