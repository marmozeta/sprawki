<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
 
class CategoryController extends Controller
{
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

        $Category = new Category;
        $Category->name = $request->name;
        $Category->active = ($request->active == 'on');
        $Category->save();
 
        return redirect('/admin/category');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $Category = Category::find($id);
        $Category->name = $request->name;
        $Category->active = 1;
        $Category->save();
 
        return redirect('/admin/category');
    }
    
    public function remove($id) {
        $Category = Category::find($id);
        $Category->delete();
        
        return redirect('/admin/category');
    }
}
