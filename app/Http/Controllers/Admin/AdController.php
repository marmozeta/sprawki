<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Ad;
 
class AdController extends Controller
{
    public function index()
    {
        $categories = Ad::all();
        return view('admin.ad', ['categories' => $categories]);
    }
    
    public function create() {
        return view('admin.forms.ad');
    }
    
    public function edit($id) {
        $ad = Menu::where('cat_id', $id)->first();
        return view('admin.forms.ad', ['ad' => $ad]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $ad = new Ad;
        $ad->name = $request->name;
        $ad->active = ($request->active == 'on');
        $ad->save();
 
        return redirect('/admin/ad');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $ad = Ad::find($id);
        $ad->name = $request->name;
        $ad->active = 1;
        $ad->save();
 
        return redirect('/admin/ad');
    }
    
    public function remove($id) {
        $ad = Ad::find($id);
        $ad->delete();
        
        return redirect('/admin/ad');
    }
}
