<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'removal_status'
    ];

//RELACION UNO A MUCHOS
    public function desings()
    {
        return $this->hasMany(Design::class);
    }
    public $timestamps = false;
}
