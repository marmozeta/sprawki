<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Tag;
use App\Models\Menu;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class HomeController extends Controller
{
    public function index($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        $elementModel = new Element;
        $elements = $elementModel->getByMenuId($menu->menu_id, (Auth::check()) ? Auth::user()->id : 0);
        $tagsModel = new Tag;
        $tags_space = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'space');
        $tags_region = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'region');
        $tags_tags = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'tag');
        
        $view = ($menu->is_social) ? 'social' : 'home'; 
        return view('front.'.$view, array('menu' => $menu, 'elements' => $elements, 'tags_tags' => $tags_tags, 'tags_region' => $tags_region, 'tags_space' => $tags_space));
    }
    
    public function show($slug, $element_id, $element_slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $elementModel = new Element;
        $element = $elementModel->getElement($element_id);
        
        $catModel = new Category;
        $product_categories = $catModel->getElementCategories($element_id);
        
        $tagModel = new Tag;
        $product_tags = $tagModel->getElementTags($element_id);
        
        $orderModel = new Order;
        $is_bought = $orderModel->checkUserOrder(Auth::id(), $element_id);
        
        return view('front.element', array(
                                        'menu' => $menu, 
                                        'element' => $element, 
                                        'product_categories' => $product_categories, 
                                        'product_tags' => $product_tags,
                                        'is_bought' => $is_bought
                                    ));
    }
}
