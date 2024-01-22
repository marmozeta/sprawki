<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Element extends Model
{
    use HasFactory;
    use SoftDeletes;    
    
    protected $primaryKey = 'element_id';  
    
    public function getBySlug($slug) {
        return DB::table('elements')
            ->select('elements.*')    
            ->join('menus', 'elements.menu_id', '=', 'menus.menu_id')
            ->where('menus.slug', $slug)
            ->whereNull('elements.deleted_at')
            ->whereNull('menus.deleted_at')
            ->get();
    }
    
    public function getByMenuId($menu_id) {
        return DB::table('elements')
            ->select(DB::raw('GROUP_CONCAT(tags.name SEPARATOR " ") AS tags, elements.*'))
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->where('elements.menu_id', $menu_id)
            ->whereNull('elements.deleted_at')
            ->groupBy('elements.element_id')
            ->get();
    }
    
    public function getElement($element_id) {
        return DB::table('elements')
            ->select(DB::raw('elements.*, GROUP_CONCAT(tags.name SEPARATOR ",") AS tags, GROUP_CONCAT(categories.cat_id SEPARATOR ",") AS product_categories, GROUP_CONCAT(DISTINCT media_uploads.filename SEPARATOR ",") AS files_to_send'))
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('element_media_uploads', 'elements.element_id', '=', 'element_media_uploads.element_element_id')
            ->leftJoin('media_uploads', 'element_media_uploads.media_upload_id', '=', 'media_uploads.id')
            ->where('elements.element_id', $element_id)
            ->whereNull('elements.deleted_at')
            ->first();
    }
}
