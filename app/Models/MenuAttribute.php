<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuAttribute extends Model
{
    use HasFactory;
    
    public function saveAttributesByMenuId($id, $attributes, $required)
    {
        self::where('menu_id', $id)->forceDelete();
        
        if(!empty($attributes)) {
            foreach($attributes as $key=>$attr) {
                $menu_attr = new self;
                $menu_attr->menu_id = $id;
                $menu_attr->attribute_id = $key;
                $menu_attr->required = (isset($required[$key]) && $required[$key] == 'on');
                $menu_attr->save();
            }
        }
    }
    
    public function getAttributesByMenuId($id) {
        $list = array();
        $attributes = self::where('menu_id', $id)->get();
        foreach($attributes as $attr) {
            $list[$attr->attribute_id] = $attr->required;
        }
        return $list;
    }
    
    public function getAttributesByMenuSlug($slug) {
         return DB::table('menu_attributes')
            ->select(DB::raw('menu_attributes.*, attributes.*'))        
            ->leftJoin('attributes', 'menu_attributes.attribute_id', '=', 'attributes.attr_id')
            ->join('menus', 'menus.menu_id', '=', 'menu_attributes.menu_id')
            ->where('menus.slug', $slug)
            ->whereNull('menus.deleted_at')
            ->orderBy('attributes.ordinal_number', 'ASC')
            ->get();
    }
}
