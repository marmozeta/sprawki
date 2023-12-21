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
        $menus = Menu::all();
        return view('admin.menu', ['menus' => $menus]);
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
