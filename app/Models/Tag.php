<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'tag_id';  
    
    public function getByMenuIdAndGroup($menu_id, $group) {
        return DB::table('tags')
            ->select(DB::raw('DISTINCT tags.name, LOWER(tags.name) AS slug'))
            ->join('element_tags', 'tags.tag_id', '=', 'element_tags.tag_tag_id')
            ->join('elements', 'elements.element_id', '=', 'element_tags.element_id')
            ->where('elements.menu_id', $menu_id)
            ->where('tags.group_slug', $group)
            ->whereNull('elements.deleted_at')
            ->get();
    }
    
    public function getElementTags($element_id) {
        return DB::table('tags')
            ->join('element_tags', 'tags.tag_id', '=', 'element_tags.tag_tag_id')
            ->where('element_tags.element_id', $element_id)
            ->where('tags.active', 1)
            ->get();
    }
}
