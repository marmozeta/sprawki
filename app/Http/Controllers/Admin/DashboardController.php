<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Element;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
    
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function search(Request $request) {  
        $result = array();
        
        if(auth()->check() && auth()->user()->is_admin==1) {
            $user_permissions = array('modify' => array(), 'remove' => array());
            $roleModel = new Role;
            $permissions = $roleModel->getUserPermissions(auth()->user()->id);
            foreach($permissions as $perm) {
                $user_permissions[$perm->perm_type][] = $perm->perm_module;
            }
        }
        
        $menuModel = new Menu();
        $elementModel = new Element();
        
        
        $menus =  $menuModel->getMenus($request->search);
        if(!empty($menus)) {
            foreach($menus as $menu) {
                $result[] = (object) array(
                    'id' => $menu->menu_id, 
                    'type' => 'menu', 
                    'type_name' => 'Pozycje menu', 
                    'name' => $menu->name,
                    'created_at' => $menu->created_at,
                    'updated_at' => $menu->updated_at,
                    'modify' => in_array('menu', $user_permissions['modify']),
                    'remove' => (in_array('menu', $user_permissions['remove']) && !$menu->is_constant)
                    );
            }
        }
        
        $menus_for_elements =  $menuModel->getMenus();
        if(!empty($menus_for_elements)) {
            foreach($menus_for_elements as $menu) {
                $elements = $elementModel->getBySlug($menu->slug, $request->search);
                foreach($elements as $element) {
                    $result[] = (object) array(
                        'id' => $element->element_id, 
                        'type' => 'element', 
                        'type_name' => $menu->name, 
                        'slug' => $menu->slug, 
                        'name' => $element->title,
                        'created_at' => $element->created_at,
                        'updated_at' => $element->updated_at,
                        'modify' => in_array($menu->slug, $user_permissions['modify']),
                        'remove' => in_array($menu->slug, $user_permissions['remove'])
                        );
                }
            }
        }
        
        return view('admin.search', ['result' => $result]);
    }
}
