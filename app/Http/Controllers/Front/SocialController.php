<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Menu;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Observed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function save_post(Request $request)
    {
        $menu = Menu::where('is_social', 1)->first();

        $element = new Element;
        $element->title = $request->title;
        $element->slug = Str::random();
        $element->image = $request->file;
        $element->description = $request->desc;
        $element->is_new = 0;
        $element->is_hot = 0;
        $element->user_id = Auth::user()->id;
        $element->menu_id = $menu->menu_id;
        $element->author = Auth::user()->friendly_name;
        $element->author_id = Auth::user()->id;
        $element->save();
        
        return redirect('/spolecznosc');
    }
    
    public function update_post(Request $request)
    {
        $menu = Menu::where('is_social', 1)->first();

        $element = Element::find($request->element_id);
        $element->title = $request->title;
        $element->image = $request->file;
        $element->description = $request->desc;
        $element->save();
        
        return redirect('/spolecznosc/'.$element->element_id.'-'.$element->slug);
    }
    
    public function remove_post($element_id) {
        $commentModel = new Comment;
        $comments = $commentModel->getCommentsByElement($element_id, 0, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        if(!$comments->isEmpty()) {
            $element = Element::find($element_id);
            $element->removed_by_user = 1;
            $element->save();
        }
        else {
            $element = Element::find($element_id);
            $element->delete();
        }
 
        return redirect('/spolecznosc');
    }
    
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/elements'),$imageName);

        return response()->json(['filename'=>$imageName]);
    }
    
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().'/images/elements/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
    
    public function save_comment(Request $request)
    {
        $comment = new Comment;
        $comment->element_id = $request->element_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        if(!empty($request->comment_id)) $comment->comment_comm_id = $request->comment_id;
        $comment->save();

        return redirect('/'.$request->redirect);
    }
    
    
    public function update_comment(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect('/'.$request->redirect);
    }
    
    public function remove_comment($element_id, $id, $redirect) {
        $commentModel = new Comment;
        $comments = $commentModel->getCommentsByElement($element_id, $id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        if(!$comments->isEmpty()) {
            $comment = Comment::find($id);
            $comment->removed_by_user = 1;
            $comment->save();
        }
        else {
            $comment = Comment::find($id);
            $comment->delete();
        }
 
        return redirect(base64_decode($redirect));
    }
    
    public function save_like(Request $request)
    {
        if(Auth::check()) {
            if(!empty($request->comment_id)) {
                $issetLike = Like::where('comment_comm_id', $request->comment_id)->where('user_id', Auth::user()->id)->first();
            }
            else {
                $issetLike = Like::where('element_element_id', $request->element_id)->where('user_id', Auth::user()->id)->first();
            }
        }
        else {
            if(!empty($request->comment_id)) {
                $issetLike = Like::where('comment_comm_id', $request->comment_id)->where('user_id', NULL)->where('ip', $request->getClientIp())->first();
            }
            else {
                $issetLike = Like::where('element_element_id', $request->element_id)->where('user_id', NULL)->where('ip', $request->getClientIp())->first();
            }
        }
        
        if(empty($issetLike)) {
            $like = new Like;
            $like->element_element_id = $request->element_id;
            if(!empty($request->comment_id)) $like->comment_comm_id = $request->comment_id;
            if(Auth::check()) $like->user_id = Auth::user()->id;
            $like->ip = $request->getClientIp();
            $like->save();
            $data = 1;
        }
        else {
            $issetLike->delete();
            $data = -1;
        }
        
        return response($data, 200);
    }
    
    public function add_to_observed(Request $request) {
        $observed = new Observed;
        $observed->user_id = $request->user_id;
        $observed->observed_id = $request->observed_id;
        $data = $observed->save();
        
        return response($data, 200);
    }
    
    public function remove_from_observed(Request $request) {
        $observed = Observed::where('user_id', $request->user_id)->where('observed_id', $request->observed_id)->first();
        $data = $observed->delete();
        
        return response($data, 200);
    }
}
