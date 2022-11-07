<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'branch',
        'first_name_contact',
        'last_name_contact',
        'phone_contact',
        'state_id',
        'city_id',
        'address',
        'removal_status'
    ];
// RELACION UNO A MUCHOS INVERSA
    public function state()
    {
    	return $this->belongsTo(State::class);
    }

// RELACION UNO A MUCHOS INVERSA
    public function city()
    {
    	return $this->belongsTo(City::class);
    }

// RELACION UNO A MUCHOS
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

// RELACION UNO A MUCHOS
    public function design()
    {
        return $this->hasMany(Design::class);
    }
    public $timestamps = false;
}
