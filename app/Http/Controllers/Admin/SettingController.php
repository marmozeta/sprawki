<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function hot() {
        $settings = Setting::where('group', 'hot')->get();
        return view('admin.settings.hot', ['settings' => $settings]);
    }
    
    public function hot_update(Request $request) {
        $setting = Setting::where('name', 'entrance_counter')->first();
        $setting->value = $request->entrance_counter;
        $save1 = $setting->save();
        
        $setting = Setting::where('name', 'comment_counter')->first();
        $setting->value = $request->comment_counter;
        $save2 = $setting->save();
        
        $setting = Setting::where('name', 'like_counter')->first();
        $setting->value = $request->like_counter;
        $save3 =$setting->save();
        
        return redirect('/admin/settings/hot');
    }
}
