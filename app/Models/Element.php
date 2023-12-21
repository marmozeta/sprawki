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
            ->join('menus', 'elements.menu_id', '=', 'menus.menu_id')
            ->where('menus.slug', $slug)
            ->whereNull('elements.deleted_at')
            ->get();
    }
}
