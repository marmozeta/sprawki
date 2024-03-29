<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
 
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', ['categories' => $categories]);
    }
    
    public function create() {
        return view('admin.forms.category');
    }
    
    public function edit($id) {
        $category = Category::where('cat_id', $id)->first();
        return view('admin.forms.category', ['category' => $category]);
    }
    
    public function store(Request $request): RedirectResponse
    {
        $category = new Category;
        $category->name = $request->name;
        if(!empty($request->icon)) $category->icon = $request->icon;
        $category->active = ($request->active == 'on');
        $category->save();
 
        return redirect('/admin/category');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $category = Category::find($id);
        $category->name = $request->name;
        if(!empty($request->icon)) $category->icon = $request->icon;
        $category->active = 1;
        $category->save();
 
        return redirect('/admin/category');
    }
    
    public function remove($id) {
        $Category = Category::find($id);
        $Category->delete();
        
        return redirect('/admin/category');
    }
}
