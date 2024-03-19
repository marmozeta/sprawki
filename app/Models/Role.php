<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;
    
    public function getRoles() {
        return DB::table('roles AS r')  
            ->select('r.*')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM users_roles WHERE users_roles.role_id = r.id) AS users'))     
            ->get();
    }
    
    public function getUserPermissions($user_id) {
        return DB::table('users_roles AS ur')  
            ->select('rp.*')
            ->join('roles_permissions AS rp', 'ur.role_id', '=', 'rp.role_id') 
            ->where('ur.user_id', '=', $user_id)
            ->get();
    }
    
    public function getUserWithRole($user_id) {
        return DB::table('users AS u')  
            ->selectRaw('u.*, ur.role_id')
            ->join('users_roles AS ur', 'ur.user_id', '=', 'u.id') 
            ->first();
    }
}
