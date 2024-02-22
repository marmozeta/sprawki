<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Flag;
 
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
    
    public function get_tags($group_slug) {
        $result = Tag::where('group_slug', $group_slug)->where('active', 1)->get();
        return response($result, 200); 
    }
    
    public function get_flags() {
        $result = Flag::all();
        return response($result, 200); 
    }
}
