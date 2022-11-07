<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

// RELACION UNO A MUCHOS INVERSA
    public function state()
    {
    	return $this->belongsTo(State::class);
    }
// RELACION UNO A MUCHOS
    public function clints()
    {
        return $this->hasMany(Client::class);
    }
    public $timestamps = false;
}
