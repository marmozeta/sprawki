<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Tag;
 
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag', ['tags' => $tags]);
    }
    
    public function create() {
        return view('admin.forms.tag');
    }
    
    public function edit($id) {
        $tag = Tag::where('tag_id', $id)->first();
        return view('admin.forms.tag', ['tag' => $tag]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->group_slug = $request->group_slug;
        $tag->active = ($request->active == 'on');
        $tag->save();
 
        return redirect('/admin/tag');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->group_slug = $request->group_slug;
        $tag->active = ($request->active == 'on');
        $tag->save();
 
        return redirect('/admin/tag');
    }
    
    public function remove($id) {
        $tag = Tag::find($id);
        $tag->delete();
        
        return redirect('/admin/tag');
    }
}
