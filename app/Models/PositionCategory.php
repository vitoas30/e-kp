<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionCategory extends Model
{
    use HasFactory;

    protected $table = 'position_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    // Relasi ke posisi
    public function positions()
    {
        return $this->hasMany(Position::class, 'category_id');
    }
}
