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
            ->selectRaw('o.*, u.*, CASE WHEN u.picture!="" THEN u.picture ELSE "person.png" END AS picture')
            ->join('users AS u', 'o.observed_id', '=', 'u.id')
            ->where('o.user_id', $user_id)
            ->get();
    }
    
    public function getIsObservable($user_id) {
        return DB::table('observed AS o')    
            ->selectRaw('o.*, u.*, CASE WHEN u.picture!="" THEN u.picture ELSE "person.png" END AS picture')
            ->join('users AS u', 'o.user_id', '=', 'u.id')
            ->where('o.observed_id', $user_id)
            ->get();
    }
    
    
    public function getOtherUsers($user_id) {
        return  DB::table('users AS u')    
            ->selectRaw('u.*, CASE WHEN u.picture!="" THEN u.picture ELSE "person.png" END AS picture')
            ->leftJoin('observed AS o', 'u.id', '=', 'o.observed_id')
            ->whereRaw('u.id <> '.$user_id.' AND o.user_id IS NULL')
            ->get();
    }
}
