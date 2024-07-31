<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'phone',
        'password',
        'profile_img',
        'company_id',
        'status',
    ];

//    relation with company
    public function company()
    {
        return $this->belongsTo(Company::class);

    }

//    relation with monitor_log
    public function monitor_logs()
    {
        return $this->hasMany(Monitor_logs::class);
    }
}
