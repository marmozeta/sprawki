<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Attribute;
use App\Models\MenuAttribute;
use Illuminate\Support\Str;
 
class MenuController extends Controller
{
    public function index()
    {
        $menus = new Menu();
        return view('admin.menu', ['menus_list' => $menus->getMenus()]);
    }
    
    public function create() {
        $attributes = Attribute::all();
        return view('admin.forms.menu', ['attributes' => $attributes, 'checked' => array()]);
    }
    
    public function edit($id) {
        $menu = Menu::where('menu_id', $id)->first();
        $attributes = Attribute::all();
        $menu_attributes =  new MenuAttribute;
        $ma_list = $menu_attributes->getAttributesByMenuId($id);
        
        return view('admin.forms.menu', ['menu' => $menu, 'attributes' => $attributes, 'checked' => $ma_list]);
    }
    
    public function store(Request $request): RedirectResponse
    {
 
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->icon = $request->icon;
        $menu->in_menu = (int)$request->in_menu;
        $menu->is_shop = (int)$request->is_shop;
        $menu->is_social = (int)$request->is_social;
        $menu->linked_elements = (int)$request->linked_elements;
        $menu->has_likes = (int)$request->has_likes;
        $menu->has_comments = (int)$request->has_comments;
        $menu->has_arguments = (int)$request->has_arguments;
        $menu->slug = Str::slug($request->name, "-");
        $menu->ordinal_number = $request->ordinal_number;
        $menu->save();
        
        $id = $menu->menu_id;
        $menu_attr = new MenuAttribute;
        $menu_attr->saveAttributesByMenuId($id, $request->attrs, $request->required);
 
        return redirect('/admin/menu');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->icon = $request->icon;
        $menu->in_menu = (int)$request->in_menu;
        $menu->is_shop = (int)$request->is_shop;
        $menu->is_social = (int)$request->is_social;
        $menu->linked_elements = (int)$request->linked_elements;
        $menu->has_likes = (int)$request->has_likes;
        $menu->has_comments = (int)$request->has_comments;
        $menu->has_arguments = (int)$request->has_arguments;
        $menu->slug = Str::slug($request->name, "-");
        $menu->ordinal_number = $request->ordinal_number;
        $menu->save();
        
        $menu_attr = new MenuAttribute;
        $menu_attr->saveAttributesByMenuId($id, $request->attrs, $request->required);
 
        return redirect('/admin/menu');
    }
    
    public function remove($id) {
        $menu = Menu::find($id);
        $menu->delete();
        
        return redirect('/admin/menu');
    }
}
