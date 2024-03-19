<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesPermission extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function deleteOldPermissions($role_id) {
        return DB::table('roles_permissions')->where('role_id', $role_id)->delete();
    }
}
