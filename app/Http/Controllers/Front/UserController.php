<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Element;
use App\Models\Menu;
use App\Models\Like;

class UserController extends Controller
{
    public function profile()
    {
        $friendly_name = request()->path();
        $user = User::where('friendly_name', $friendly_name)->first();
        
        $elementModel = new Element;
        $elements = $elementModel->getSocialElementsByUser($user->id);
        
        $commentModel = new Comment;
        $comments = $commentModel->getCommentsByUser($user->id);
        
        $menu = Menu::where('is_social', 1)->first();
        
        $likesModel = new Like;
        $likes = $likesModel->getLikesByUser($user->id);
        
        return view('front.profile', array('user' => $user, 'menu' => $menu, 'comments' => $comments, 'elements' => $elements, 'likes' => $likes));
    }
}
