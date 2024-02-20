<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ElementArgument extends Model
{
    use HasFactory;
    
    public function getArgumentsByElement($element_id) {
        return DB::table('element_arguments')
            ->join('users', 'element_arguments.user_id', '=', 'users.id')
            ->whereNull('element_arguments.deleted_at')
            ->where('element_id', $element_id)
            ->get();
    }
}
