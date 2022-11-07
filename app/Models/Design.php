<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'design',
        'design_title',
        'status',
        'designer_id',
        'client_id',
        'removal_status'
    ];

//RELACION MUCHOS A MUCHOS
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

//RELACION UNO A MUCHOS INVERSA
    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }
    public $timestamps = false;
}
