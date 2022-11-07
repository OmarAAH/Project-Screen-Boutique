<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'first_name',
        'last_name',
        'phone',
        'photo',
        'removal_status'
    ];

// RELACION UNO A UNO INVERSA
    public function users()
    {
    	return $this->hasOne(User::class);
    }

// RELACION UNO A MUCHOS
    public function sales()
    {
    	return $this->hasMany(Sale::class);
    }
    public $timestamps = false;
}
