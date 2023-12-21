<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
 
class OrderController extends Controller
{
    public function index()
    {
        $categories = Order::all();
        return view('admin.order', ['categories' => $categories]);
    }
    
    public function create() {
        return view('admin.forms.order');
    }
    
    public function edit($id) {
        $order = Menu::where('cat_id', $id)->first();
        return view('admin.forms.order', ['order' => $order]);
    }
    
    public function store(Request $request): RedirectResponse
    {

        $order = new Order;
        $order->name = $request->name;
        $order->active = ($request->active == 'on');
        $order->save();
 
        return redirect('/admin/order');
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
 
        $order = Order::find($id);
        $order->name = $request->name;
        $order->active = 1;
        $order->save();
 
        return redirect('/admin/order');
    }
    
    public function remove($id) {
        $order = Order::find($id);
        $order->delete();
        
        return redirect('/admin/order');
    }
}
