<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = 'sub_menus';
    
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
