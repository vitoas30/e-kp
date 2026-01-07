<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContract extends Model
{
    protected $table = 'employee_contracts';

    protected $guarded = [];

    // Relasi ke posisi
    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class, 'employee_type_id');
    }
}
