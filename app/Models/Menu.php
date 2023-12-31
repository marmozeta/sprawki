<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $primaryKey = 'menu_id';
    
    public function getMenus() {
        return DB::table('menus')
            ->select(DB::raw('menus.*, GROUP_CONCAT(attributes.slug SEPARATOR ", ") AS attrs_list'))
            ->join('menu_attributes', 'menus.menu_id', '=', 'menu_attributes.menu_id')
            ->join('attributes', 'attributes.attr_id', '=', 'menu_attributes.attribute_id')
            ->groupBy('menus.menu_id')
            ->whereNull('menus.deleted_at')
            ->get();
    }
}
