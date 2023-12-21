<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
 
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user', ['users' => $users]);
    }
    
    public function create() {
        return view('admin.forms.user');
    }
    
    public function edit($id) {
        $user = User::where('user_id', $id)->first();
        return view('admin.forms.user', ['user' => $user]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $user = new User;
        $user->name = $request->name;
        $user->active = ($request->active == 'on');
        $user->save();
 
        return redirect('/admin/user');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->active = 1;
        $user->save();
 
        return redirect('/admin/user');
    }
    
    public function remove($id) {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/admin/user');
    }
}
