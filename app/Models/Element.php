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
    
    public function getBySlug($slug, $search = null) {
        $result = DB::table('elements')
            ->selectRaw('elements.*, CASE WHEN elements.author_id > 0 THEN users.friendly_name ELSE elements.author END AS friendly_name')      
            ->join('menus', 'elements.menu_id', '=', 'menus.menu_id')
            ->leftJoin('users', 'users.id', '=', 'elements.author_id')
            ->where('menus.slug', $slug)
            ->whereNull('elements.deleted_at')
            ->whereNull('menus.deleted_at')
            ->orderBy('elements.created_at', 'DESC');
        
        if(!empty($search)) $result->whereRaw("(title LIKE '%{$search}%' OR description LIKE '%{$search}%')");
        return $result->get();
    }
    
    public function getByMenuId($menu_id, $user_id, $ip, $tag = NULL) {
        $result = Element::selectRaw('GROUP_CONCAT(LOWER(tags.name) SEPARATOR " ") AS tags, elements.*, 
                    CASE WHEN elements.author_id > 0 THEN users.friendly_name ELSE elements.author END AS friendly_name, 
                    CASE WHEN elements.author_id >0 THEN users.picture ELSE "person.png" END AS picture,
                    GROUP_CONCAT(CONCAT("<i class=\'", categories.icon, "\'></i>", categories.name) SEPARATOR ", ") AS product_categories, 1 AS is_liked')     
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('users', 'users.id', '=', 'elements.author_id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = elements.element_id) as comments'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0) as likes'))
            ->where('elements.menu_id', $menu_id)
            ->whereNull('elements.deleted_at')
            ->whereRaw('elements.publish_date <= NOW()')
            ->orderBy('elements.created_at', 'DESC')  
            ->groupBy('elements.element_id');
        
        if(!empty($tag)) $result->where('tags.name', '=', urldecode($tag));
        
        if(!empty($user_id)) {
            $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0 AND likes.user_id = '.$user_id.') as is_liked'));
            $result->addSelect(DB::raw('(SELECT COUNT(*) FROM element_user_logs WHERE element_user_logs.element_id = elements.element_id AND element_user_logs.user_id = '.$user_id.') as is_read'));
        }
        else {
            $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0 AND likes.ip = "'.$ip.'") as is_liked'));
        }
        return $result->get();
    }
    
    public function getElementForEdit($element_id) {
        return DB::table('elements')
            ->select(DB::raw('elements.*,
                    GROUP_CONCAT(CASE WHEN tags.group_slug="tag" THEN tags.name END SEPARATOR ",") AS tag_tags, 
                    GROUP_CONCAT(CASE WHEN tags.group_slug="space" THEN tags.name END SEPARATOR ",") AS space_tags, 
                    GROUP_CONCAT(CASE WHEN tags.group_slug="region" THEN tags.name END SEPARATOR ",") AS region_tags, 
                    GROUP_CONCAT(categories.cat_id SEPARATOR ",") AS product_categories, GROUP_CONCAT(DISTINCT media_uploads.filename SEPARATOR ",") AS files_to_send'))
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
    
    public function getElement($element_id, $user_id, $ip) {
        $result = DB::table('elements')
            ->select(DB::raw('elements.*, 
                    CASE WHEN elements.author_id > 0 THEN u.friendly_name ELSE elements.author END AS friendly_name, 
                    CASE WHEN elements.author_id >0 THEN u.picture ELSE "person.png" END AS picture,
                    GROUP_CONCAT(tags.name SEPARATOR ",") AS tags, 
                    GROUP_CONCAT(categories.cat_id SEPARATOR ",") AS product_categories, 
                    GROUP_CONCAT(DISTINCT media_uploads.filename SEPARATOR ",") AS files_to_send'))
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('element_media_uploads', 'elements.element_id', '=', 'element_media_uploads.element_element_id')
            ->leftJoin('media_uploads', 'element_media_uploads.media_upload_id', '=', 'media_uploads.id')
            ->leftJoin('users AS u', 'elements.author_id', '=', 'u.id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = elements.element_id) as comments'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0) as likes'))
            ->where('elements.element_id', $element_id)
            ->whereNull('elements.deleted_at');
        
        if(!empty($user_id)) $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0 AND likes.user_id = '.$user_id.') as is_liked'));
        else $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.comment_comm_id = 0 AND likes.ip = "'.$ip.'") as is_liked'));
            
        return $result->first();
    }
    
    public function getSocialElementsByUser($user_id) {
        return Element::selectRaw('GROUP_CONCAT(LOWER(tags.name) SEPARATOR " ") AS tags, elements.*, users.friendly_name, users.picture, GROUP_CONCAT(CONCAT("<i class=\'", categories.icon, "\'></i>", categories.name) SEPARATOR ", ") AS product_categories, 1 AS is_liked')               
            ->leftJoin('menus', 'menus.menu_id', '=', 'elements.menu_id')
            ->leftJoin('element_tags', 'elements.element_id', '=', 'element_tags.element_id')
            ->leftJoin('tags', 'element_tags.tag_tag_id', '=', 'tags.tag_id')
            ->leftJoin('element_categories', 'elements.element_id', '=', 'element_categories.element_element_id')
            ->leftJoin('categories', 'element_categories.category_cat_id', '=', 'categories.cat_id')
            ->leftJoin('users', 'users.id', '=', 'elements.user_id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = elements.element_id) as comments'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = elements.element_id) as likes'))
           // ->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = elements.element_id AND likes.user_id = '.(int)$user_id.') as is_liked'))
            ->where('menus.is_social', 1)
            ->where('elements.user_id', $user_id)
            ->whereNull('elements.deleted_at')
            ->orderBy('elements.created_at', 'DESC')  
            ->groupBy('elements.element_id')
            ->get();
    }
}
