<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Element;
use App\Models\Attribute;
use App\Models\MenuAttribute;
use Illuminate\Support\Str;
 
class ElementController extends Controller
{
    public function index($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        $elements = new Element;
        return view('admin.element', ['menu' => $menu, 'elements' => $elements->getBySlug($slug)]);
    }
    
    public function create($slug) {
        $menu = Menu::where('slug', $slug)->first();
        $element_attributes =  new MenuAttribute;
        $attributes = $element_attributes->getAttributesByMenuSlug($slug);
        return view('admin.forms.element', ['menu' => $menu, 'attributes' => $attributes, 'checked' => array()]);
    }
    
    public function edit($slug, $id) {
        $menu = Menu::where('slug', $slug)->first();
        $element = Element::find($id);
        
        $element_attributes =  new MenuAttribute;
        $attributes = $element_attributes->getAttributesByMenuSlug($slug);
        
        return view('admin.forms.element', ['menu' => $menu, 'element' => $element, 'attributes' => $attributes]);
    }
    
    public function store(Request $request, $slug): RedirectResponse
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $element = new Element;
        $element->title = $request->title;
        $element->slug = Str::slug($request->name, "-");
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->is_new = (int)$request->is_new;
        $element->is_hot = (int)$request->is_hot;
        $element->user_id = 1;
        $element->menu_id = $menu->menu_id;
        $element->save();

        return redirect('/admin/element/'.$slug);
    }
    
    public function update(Request $request, $slug, $id): RedirectResponse
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $element = Element::find($id);
        $element->title = $request->title;
        $element->slug = Str::slug($request->name, "-");
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->is_new = (int)$request->is_new;
        $element->is_hot = (int)$request->is_hot;
        $element->user_id = 1;
        $element->menu_id = $menu->menu_id;
        $element->save();

        return redirect('/admin/element/'.$slug);
    }
    
    public function remove($slug, $id) {
        $element = Element::find($id);
        $element->delete();
        
        return redirect('/admin/element/'.$slug);
    }
}
