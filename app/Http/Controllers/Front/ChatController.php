<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Chat;

class ChatController extends Controller
{
    public function index() {
       // $participants = [User::find(1), User::find(2)];
      //  $conversation = Chat::createConversation($participants);
        
        $participants = User::all();   
        return view('front.chat', array('participants' => $participants));
    }
    
    public function get_participants() {
        $result = User::all();   
        return response($result, 200); 
    }
}
