<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, HasApiTokens, HasFactory;

    protected $fillable = [
        'user',
        'password',
        'role_id',
        'employee_id',
        'removal_status'
    ];

// RELACION UNO A MUCHOS
    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
// RELACION UNO A MUCHOS   
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public $timestamps = false;
}