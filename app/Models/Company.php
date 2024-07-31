<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'logo',
        'website',
        'phone',
        'address',
        'password',
        'screenShot_time',
        'no_of_employees',
        'allowed_email',
        'status',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);

    }
}
