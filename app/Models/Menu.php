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
    
    public function getMenus($search = null) {
        $result = DB::table('menus')
            ->select(DB::raw('menus.*, GROUP_CONCAT(attributes.slug SEPARATOR ", ") AS attrs_list'))
            ->leftJoin('menu_attributes', 'menus.menu_id', '=', 'menu_attributes.menu_id')
            ->leftJoin('attributes', 'attributes.attr_id', '=', 'menu_attributes.attribute_id')
            ->groupBy('menus.menu_id')
            ->whereNull('menus.deleted_at');
        
        if(!empty($search)) $result->whereRaw("menus.name LIKE '%{$search}%'");
        
        return $result->get();
    }
    
    public function getMenuBySlug($slug) {
        $result = DB::table('menus')
            ->select(DB::raw('menus.*, GROUP_CONCAT(attributes.slug SEPARATOR ",") AS attrs_list'))
            ->leftJoin('menu_attributes', 'menus.menu_id', '=', 'menu_attributes.menu_id')
            ->leftJoin('attributes', 'attributes.attr_id', '=', 'menu_attributes.attribute_id')
            ->where('menus.slug', '=', $slug)
             ->first();
        $result->attrs_list = explode(',', $result->attrs_list);
        return $result;
    }
}
