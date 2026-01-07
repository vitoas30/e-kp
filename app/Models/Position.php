<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(PositionCategory::class, 'category_id');
    }
}
