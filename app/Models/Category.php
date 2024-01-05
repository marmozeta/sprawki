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
}
