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

class SocialController extends Controller
{
    public function save_post(Request $request)
    {
        $menu = Menu::where('is_social', 1)->first();

        $element = new Element;
        $element->title = '';
        $element->slug = '';
        $element->image = $request->file;
        $element->description = $request->desc;
        $element->is_new = 0;
        $element->is_hot = 0;
        $element->user_id = Auth::user()->get('id');
        $element->menu_id = $menu->menu_id;
        $element->author = Auth::user()->get('name');
        $element->save();
        
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
        $comment->save();
        
        return redirect('/'.$request->redirect);
    }
    
    public function save_like(Request $request)
    {
        if(Auth::check()) {
            $issetLike = Like::where('element_element_id', $request->element_id)->where('user_id', Auth::user()->id)->first();
        }
        
        if(empty($issetLike)) {
            $like = new Like;
            $like->element_element_id = $request->element_id;
            if(Auth::check()) $like->user_id = Auth::user()->id;
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
