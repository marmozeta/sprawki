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
    
    public function getByMenuId($menu_id, $user_id) {
        return Element::selectRaw('GROUP_CONCAT(LOWER(tags.name) SEPARATOR " ") AS tags, elements.*, GROUP_CONCAT(CONCAT("<i class=\'", categories.icon, "\'></i>", categories.name) SEPARATOR ", ") AS product_categories')     
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = elements.element_id) as comments'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = elements.element_id) as likes'))
            ->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.user_id = '.(int)$user_id.') as is_liked'))
            ->where('elements.menu_id', $menu_id)
            ->whereNull('elements.deleted_at')
            ->orderBy('elements.created_at', 'DESC')  
            ->groupBy('elements.element_id')
            ->get();
    }
    
    public function getElementForEdit($element_id) {
        return DB::table('elements')
            ->select(DB::raw('elements.*, GROUP_CONCAT(tags.name SEPARATOR ",") AS tags, GROUP_CONCAT(categories.cat_id SEPARATOR ",") AS product_categories, GROUP_CONCAT(DISTINCT media_uploads.filename SEPARATOR ",") AS files_to_send'))
            //->select(DB::raw('COUNT(comments.comm_id) AS comments'))
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('element_media_uploads', 'elements.element_id', '=', 'element_media_uploads.element_element_id')
            ->leftJoin('media_uploads', 'element_media_uploads.media_upload_id', '=', 'media_uploads.id')
           // ->leftJoin('comments', 'comments.element_id', '=', 'elements.element_id')  
            ->where('elements.element_id', $element_id)
            ->whereNull('elements.deleted_at')
            ->first();
    }
    
    public function getElement($element_id, $user_id) {
        return DB::table('elements')
            ->select(DB::raw('elements.*, GROUP_CONCAT(tags.name SEPARATOR ",") AS tags, GROUP_CONCAT(categories.cat_id SEPARATOR ",") AS product_categories, GROUP_CONCAT(DISTINCT media_uploads.filename SEPARATOR ",") AS files_to_send'))
            //->select(DB::raw('COUNT(comments.comm_id) AS comments'))
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('element_media_uploads', 'elements.element_id', '=', 'element_media_uploads.element_element_id')
            ->leftJoin('media_uploads', 'element_media_uploads.media_upload_id', '=', 'media_uploads.id')
           // ->leftJoin('comments', 'comments.element_id', '=', 'elements.element_id')  
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = elements.element_id) as comments'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = elements.element_id) as likes'))
            ->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.user_id = '.$user_id.') as is_liked'))     
            ->where('elements.element_id', $element_id)
            ->whereNull('elements.deleted_at')
            ->first();
    }
}
