<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor_logs extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'images_url',
        'check_in_time',
        'check_out_time',
        'status',

    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);

    }
}
