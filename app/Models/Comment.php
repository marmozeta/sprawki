<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'comm_id';   
    
    public function getComments() {
        return DB::table('comments')
            ->selectRaw('comments.*, users.friendly_name, users.picture')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->whereNull('comments.deleted_at')
            ->get();
    }
    
    public function getCommentsByElement($element_id) {
        return DB::table('comments AS c')
            ->selectRaw('c.*, users.friendly_name, users.name, users.picture, u2.friendly_name AS owner_friendly_name, 
                u2.name AS owner_name, u2.picture AS owner_picture, 
                    CASE WHEN cr.comment IS NOT NULL THEN cr.comment WHEN e.title IS NOT NULL THEN e.title ELSE SUBSTR(e.description, 0, 50) END AS teaser
                    ')
            ->join('elements AS e', 'e.element_id', '=', 'c.element_id')
            ->leftJoin('users AS u2', 'e.user_id', '=', 'u2.id')
            ->leftJoin('users', 'c.user_id', '=', 'users.id')
            ->leftJoin('comments AS cr', 'c.comment_comm_id', '=', 'cr.comm_id')
            ->whereNull('c.deleted_at')
            ->where('c.element_id', $element_id)
            ->get();
    }
    
    public function getCommentsByUser($user_id) {
        return DB::table('comments AS c')
            ->selectRaw('c.*, users.friendly_name, users.name, users.picture, u2.friendly_name AS owner_friendly_name, 
                u2.name AS owner_name, u2.picture AS owner_picture, 
                    CASE WHEN cr.comment IS NOT NULL THEN cr.comment WHEN e.title IS NOT NULL THEN e.title ELSE SUBSTR(e.description, 0, 50) END AS teaser
                    ')
            ->join('elements AS e', 'e.element_id', '=', 'c.element_id')
            ->leftJoin('users AS u2', 'e.user_id', '=', 'u2.id')
            ->leftJoin('users', 'c.user_id', '=', 'users.id')
            ->leftJoin('comments AS cr', 'c.comment_comm_id', '=', 'cr.comm_id')
            ->whereNull('c.deleted_at')
            ->where('c.user_id', $user_id)
            ->get();
    }
}
