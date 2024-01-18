<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'cat_id';    
    
    public function getBySlug($slug) {
        return DB::table('categories')
            ->join('menus', 'elements.menu_id', '=', 'menus.menu_id')
            ->where('menus.slug', $slug)
            ->whereNull('elements.deleted_at')
            ->whereNull('menus.deleted_at')
            ->get();
    }
    
    public function getElementCategories($element_id) {
        return DB::table('categories')
            ->join('element_categories', 'categories.cat_id', '=', 'element_categories.category_cat_id')
            ->where('element_categories.element_element_id', $element_id)
            ->where('categories.active', 1)
            ->get();
    }
}
