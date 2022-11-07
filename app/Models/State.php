<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

// RELACION UNO A MUCHOS
    public function cities()
    {
        return $this->hasMany(City::class);
    }

// RELACION UNO A MUCHOS
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public $timestamps = false;
}
