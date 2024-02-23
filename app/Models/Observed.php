<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Observed extends Model
{
    use HasFactory;
    
    protected $table = 'observed';
    
    public function getObserved($user_id) {
        return DB::table('observed AS o')    
            ->join('users AS u', 'o.observed_id', '=', 'u.id')
            ->where('o.user_id', $user_id)
            ->get();
    }
    
    public function getIsObservable($user_id) {
        return DB::table('observed AS o')    
            ->join('users AS u', 'o.user_id', '=', 'u.id')
            ->where('o.observed_id', $user_id)
            ->get();
    }
}
