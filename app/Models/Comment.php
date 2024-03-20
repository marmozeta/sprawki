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
    
    public function getCommentsByElement($element_id, $parent_id, $user_id, $ip) {
        $result = DB::table('comments AS c')
            ->selectRaw('c.*, users.friendly_name, users.id, users.name, users.picture, u2.id AS owner_id, u2.friendly_name AS owner_friendly_name, 
                u2.name AS owner_name, u2.picture AS owner_picture
                    ')
            ->join('elements AS e', 'e.element_id', '=', 'c.element_id')
            ->leftJoin('users AS u2', 'e.user_id', '=', 'u2.id')
            ->leftJoin('users', 'c.user_id', '=', 'users.id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id) as likes'))
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.element_id = e.element_id AND comments.comment_comm_id = c.comm_id) as comments'))
            ->whereNull('c.deleted_at')
            ->where('c.element_id', $element_id)
            ->where('c.comment_comm_id', $parent_id);
        
        
        if(!empty($user_id)) $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id AND likes.user_id = '.$user_id.') as is_liked'));
        else $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id AND likes.ip = "'.$ip.'") as is_liked'));
        return $result->get();
    }
    
    public function getCommentsByUser($parent_id, $user_id, $ip, $logged_user) {
        $result = DB::table('comments AS c')
            ->selectRaw('c.*, users.id, users.friendly_name, users.name, users.picture, u3.friendly_name AS comment_friendly_name, 
                u3.name AS comment_name, u3.picture AS comment_picture, 
                    e.title, CONCAT(m.slug, "/", e.element_id, "-", e.slug) AS url')
            ->join('elements AS e', 'e.element_id', '=', 'c.element_id')
            ->join('menus AS m', 'm.menu_id', '=', 'e.menu_id')
            ->leftJoin('users', 'c.user_id', '=', 'users.id')
            ->leftJoin('comments AS cr', 'c.comment_comm_id', '=', 'cr.comm_id')
            ->leftJoin('users AS u3', 'cr.user_id', '=', 'users.id')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = 0) as owner_likes'))                    
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id) as likes'))           
            ->whereNull('c.deleted_at')
            ->where('c.user_id', $user_id)
            ->where('c.comment_comm_id', $parent_id);
        
            if(!empty($logged_user)) {
                $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id AND likes.user_id = '.$logged_user.') as is_liked'));
                $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = 0 AND likes.user_id = '.$logged_user.') as owner_is_liked'));
            }
            else {
                $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = c.comm_id AND likes.ip = "'.$ip.'") as is_liked'));
                $result->addSelect(DB::raw('(SELECT 1 FROM likes WHERE likes.element_element_id = e.element_id AND likes.comment_comm_id = 0 AND likes.ip = "'.$ip.'") as owner_is_liked'));
            }

            $new_comments = array();             
            $comments = $result->groupBy('c.comm_id')->get();
            
            if(!empty($comments)) {
                foreach($comments as $comment) {
                    $new_comments[$comment->element_id][] = $comment;
                }
            }
            return $new_comments;
    }
}
