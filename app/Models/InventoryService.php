<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryService extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_item_id',
        'user_id',
        'request_date',
        'description',
        'status',
        'cost',
        'proof_of_payment',
        'admin_note',
        'completion_date',
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
