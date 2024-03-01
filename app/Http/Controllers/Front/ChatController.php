<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Chat;
use App\Models\User;

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
    
    public function new_chat(Request $request) {
        $participants = array();
        $userslist = json_decode($request->userslist);
        foreach($userslist as $user) {
            $participants[] = User::find($user->value);
        }
       
        $conversation = Chat::createConversation($participants)->makePrivate();
        $hash = base64_encode($conversation->id."_".$conversation->created_at);
        
        return response($hash, 200);
    }
    
    public function chat($hash) {
        
        $auth_user = User::find(Auth::user()->id);
        
        $hash_tab = explode('_', base64_decode($hash));
        $conversation_id = (int)$hash_tab[0];
        $conversation = Chat::conversations()->getById($conversation_id);
        $participants = $conversation->getParticipants();
        print_r($participants);exit;
        $messages = Chat::conversation($conversation)->setParticipant($auth_user)->getMessages();
        
        $message = Chat::message('Hello')
            ->from($participants->where('messegeable_id', 1)->first())
            ->to($conversation)
            ->send();
        
        return view('front.chat', array('conversation' => $conversation, 'participants' => $participants, 'messages' => $messages));   
    }
}
