<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Menu;
use App\Models\RolesPermission;
 
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
    
    public function index()
    {
        $users = User::all();
        return view('admin.user', ['users' => $users]);
    }
    
    public function create() {
        return view('admin.forms.user');
    }
    
    public function edit($id) {
        $user = User::where('id', $id)->first();
        return view('admin.forms.user', ['user' => $user]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
 
        return redirect('/admin/user');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $user->name = $request->name;
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->active = 1;
        $user->save();
 
        return redirect('/admin/user');
    }
    
    public function remove($id) {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/admin/user');
    }
    
    public function role_index()
    {
        $roleModel = new Role;
        $roles = $roleModel->getRoles();
        
        $menus = Menu::orderBy('ordinal_number', 'asc')->get();
        return view('admin.role', ['roles' => $roles, 'menus' => $menus]);
    }
    
    public function create_role() {
        $permissions = array('modify' => array(), 'remove' => array());
        return view('admin.forms.role', ['permissions' => $permissions]);
    }
    
    public function edit_role($id) {
        $perm_tab = array('modify' => array(), 'remove' => array());
        $role = Role::where('id', $id)->first();
        $permissions = RolesPermission::where('role_id', $id)->get();
        foreach($permissions as $perm) {
            $perm_tab[$perm->perm_type][] = $perm->perm_module;
        }
        
        return view('admin.forms.role', ['role' => $role, 'permissions' => $perm_tab]);
    }
    
    public function store_role(Request $request): RedirectResponse
    {
        $role = new Role;
        $role->role_name = $request->role_name;
        $role->save();
        
        $perms = array();
        
        $menus = Menu::all();
        foreach($menus as $menu) {
            if(isset($request->{$menu->slug}) && $request->{$menu->slug} == 'on') {
                if(isset($request->modify[$menu->slug]) && $request->modify[$menu->slug]=='on') $perms[] = $menu->slug.'_modify';
                if(isset($request->remove[$menu->slug]) && $request->remove[$menu->slug]=='on') $perms[] = $menu->slug.'_remove';
            }
        }
        
        $lista_uprawnien = array('tagi', 'kategorie', 'media', 'uzytkownicy', 'role', 'komentarze', 'sprzedaz');
        
        foreach($lista_uprawnien as $uprawnienie) {
            if(isset($request->{$uprawnienie}) && $request->{$uprawnienie} == 'on') {
                if(isset($request->modify[$uprawnienie]) && $request->modify[$uprawnienie]=='on') $perms[] = $uprawnienie.'_modify';
                if(isset($request->remove[$uprawnienie]) && $request->remove[$uprawnienie]=='on') $perms[] = $uprawnienie.'_remove';
            }
        }
        
        if(isset($request->ustawienia) && $request->ustawienia == 'on') $perms[] = 'ustawienia_modify';
        
        if(!empty($perms)) {
            foreach($perms as $perm) {
                if(!empty($perm)) {
                    list($module, $type) = explode('_', $perm);
                }
                $add_role = new RolesPermission;
                $add_role->role_id = $role->id;
                $add_role->perm_module = $module;
                $add_role->perm_type = $type;
                $add_role->save();
            }
        }
 
        return redirect('/admin/role');
    }
    
    public function update_role(Request $request, $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $role->save();
        
        $rpModel = new RolesPermission;
        $rpModel->deleteOldPermissions($id);
        
        $perms = array();
        
        $menus = Menu::all();
        foreach($menus as $menu) {
            if(isset($request->{$menu->slug}) && $request->{$menu->slug} == 'on') {
                if(isset($request->modify[$menu->slug]) && $request->modify[$menu->slug]=='on') $perms[] = $menu->slug.'_modify';
                if(isset($request->remove[$menu->slug]) && $request->remove[$menu->slug]=='on') $perms[] = $menu->slug.'_remove';
            }
        }
        
        $lista_uprawnien = array('tagi', 'kategorie', 'media', 'uzytkownicy', 'role', 'komentarze', 'sprzedaz');
        
        foreach($lista_uprawnien as $uprawnienie) {
            if(isset($request->{$uprawnienie}) && $request->{$uprawnienie} == 'on') {
                if(isset($request->modify[$uprawnienie]) && $request->modify[$uprawnienie]=='on') $perms[] = $uprawnienie.'_modify';
                if(isset($request->remove[$uprawnienie]) && $request->remove[$uprawnienie]=='on') $perms[] = $uprawnienie.'_remove';
            }
        }
        
        if(isset($request->ustawienia) && $request->ustawienia == 'on') $perms[] = 'ustawienia_modify';
        
        if(!empty($perms)) {
            foreach($perms as $perm) {
                if(!empty($perm)) {
                    list($module, $type) = explode('_', $perm);
                }
                $add_role = new RolesPermission;
                $add_role->role_id = $role->id;
                $add_role->perm_module = $module;
                $add_role->perm_type = $type;
                $add_role->save();
            }
        }
 
        return redirect('/admin/role');
    }
    
    public function remove_role($id) {
        $role = Role::find($id);
        $role->delete();
        
        $rpModel = new RolesPermission;
        $rpModel->deleteOldPermissions($id);
        
        return redirect('/admin/role');
    }
}
