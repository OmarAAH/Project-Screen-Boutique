<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Sale extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    public $fillable = [
        'created_at',
        'sold',
        'total',
        'employee_id',
        'product_id',
        'delivery_id',
        'client_id',
        'design_id',
    ];

//RELACION MUCHOS A MUCHOS
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

//RELACION MUCHOS A MUCHOS
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

//RELACION UNO A MUCHOS INVERSA
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

//RELACION UNO A MUCHOS INVERSA
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public $timestamps = false;
}
