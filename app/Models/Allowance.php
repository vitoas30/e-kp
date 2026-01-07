<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $table = 'allowances';
    
    protected $guarded = [];

    // Relasi ke posisi
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'employee_type_id');
    // }
}
