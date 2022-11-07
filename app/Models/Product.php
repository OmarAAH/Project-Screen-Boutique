<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Product extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $fillable = [
        'code',
        'quantity',
        'price',
        'returns',
        'recycling',
        'color_id',
        'type_id',
        'size_id',
        'removal_status'
    ];

// RELACION UNO A MUCHOS INVERSA
    public function color()
    {
    	return $this->belongsTo(Color::class);
    }

// RELACION UNO A MUCHOS INVERSA
    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

// RELACION UNO A MUCHOS INVERSA
    public function size()
    {
    	return $this->belongsTo(Size::class);
    }
//RELACION MUCHOS A MUCHOS
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public $timestamps = false;
}
