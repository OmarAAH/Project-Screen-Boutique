<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'removal_status'
    ];

//RELACION MUCHOS A MUCHOS
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public $timestamps = false;
}
