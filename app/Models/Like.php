<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'like_id';   
    
    public function getLikesByUser($user_id) {
        return DB::table('likes')
            ->selectRaw('likes.*, u.friendly_name, u.name, u.picture, u2.friendly_name AS owner_friendly_name, 
                u2.name AS owner_name, u2.picture AS owner_picture, uc.friendly_name AS comment_friendly_name, uc.name AS comment_name,
                    CASE WHEN c.comment IS NOT NULL THEN c.comment WHEN elements.title IS NOT NULL THEN elements.title ELSE SUBSTR(elements.description, 0, 50) END AS teaser')
            ->join('elements', 'elements.element_id', '=', 'likes.element_element_id')
            ->join('users AS u', 'likes.user_id', '=', 'u.id')
            ->join('users AS u2', 'elements.user_id', '=', 'u2.id')
            ->leftJoin('comments AS c', 'likes.comment_comm_id', '=', 'c.comm_id')
            ->leftJoin('users AS uc', 'c.user_id', '=', 'uc.id')
            ->whereNull('likes.deleted_at')
            ->where('likes.user_id', $user_id)
            ->groupby('elements.element_id')
            ->get();
    }
}
