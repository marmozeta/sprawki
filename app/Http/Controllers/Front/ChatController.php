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
        $messages = array();
        return view('front.chat', array('participants' => $participants, 'messages' => $messages));
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
        $messages = Chat::conversation($conversation)->setParticipant($auth_user->first())->getMessages();
      /*  $message = Chat::message('Nowa wiadomość')
            ->from($participants->last())
            ->to($conversation)
            ->send();*/
        
        return view('front.chat', array('conversation' => $conversation, 'participants' => $participants, 'messages' => $messages));   
    }
}
