<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAllowance extends Model
{
    protected $table = 'user_allowances';

    protected $guarded = [];

    // Relasi ke posisi
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'employee_type_id');
    // }

    public function allowance()
    {
        return $this->belongsTo(Allowance::class, 'allowance_id');
    }
}
