<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Element;
use App\Models\Menu;
use App\Models\Like;
use App\Models\Observed;
use Illuminate\Support\Facades\Auth;

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
        
        $observed = Observed::where('user_id', $user->id)->count();
        $is_observable = Observed::where('observed_id', $user->id)->count();
        $logged_in_is_observable = (Auth::check()) ? Observed::where('observed_id', $user->id)->where('user_id', Auth::user()->id)->count() : 0;
        
        return view('front.profile', array('user' => $user, 'menu' => $menu, 'comments' => $comments, 'elements' => $elements, 'likes' => $likes, 'observed' => $observed, 'is_observable' => $is_observable, 'logged_in_is_observable' => $logged_in_is_observable));
    }
    
    public function observed()
    {
        $path_tab = explode('/', request()->path());
        $friendly_name = $path_tab[0];
        $user = User::where('friendly_name', $friendly_name)->first();               
        
        $observedModel = new Observed;
        $observed_list = $observedModel->getObserved($user->id);
        $is_observable_list = $observedModel->getIsObservable($user->id);
        $observed = Observed::where('user_id', $user->id)->count();
        $is_observable = Observed::where('observed_id', $user->id)->count();
        
        return view('front.observed', array('user' => $user, 'observed_list' => $observed_list, 'is_observable_list' => $is_observable_list, 'observed' => $observed, 'is_observable' => $is_observable));
    }
}
