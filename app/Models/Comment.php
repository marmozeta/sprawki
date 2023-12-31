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
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->whereNull('comments.deleted_at')
            ->get();
    }
}
