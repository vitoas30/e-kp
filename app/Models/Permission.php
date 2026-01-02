<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    } 

    public function position()
    {
        return $this->belongsTo(PositionCategory::class, 'position_id');
    } 
}
