<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
 
class CommentController extends Controller
{
    public function index()
    {
        $categories = Comment::all();
        return view('admin.comment', ['categories' => $categories]);
    }
    
    public function create() {
        return view('admin.forms.comment');
    }
    
    public function edit($id) {
        $comment = Menu::where('cat_id', $id)->first();
        return view('admin.forms.comment', ['comment' => $comment]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->active = ($request->active == 'on');
        $comment->save();
 
        return redirect('/admin/comment');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $comment = Comment::find($id);
        $comment->name = $request->name;
        $comment->active = 1;
        $comment->save();
 
        return redirect('/admin/comment');
    }
    
    public function remove($id) {
        $comment = Comment::find($id);
        $comment->delete();
        
        return redirect('/admin/comment');
    }
}
