<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    protected $table = 'employee_types';
    
    protected $guarded = [];

    protected $casts = [
        'has_end_date' => 'boolean',
    ];

    // Relasi ke posisi
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'employee_type_id');
    // }
}
