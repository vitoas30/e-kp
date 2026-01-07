<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_item_id',
        'description',
        'user_id',
        'condition',
        'purchase_date',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(InventoryService::class);
    }
}
