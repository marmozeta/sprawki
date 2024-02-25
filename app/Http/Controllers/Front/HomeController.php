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
use App\Models\Comment;
use App\Models\ElementArgument;

class HomeController extends Controller
{
    public function index()
    {
        $slug = request()->path();
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
    
    public function show($element_id, $element_slug)
    {
        $path = request()->path();
        $slug_tab = explode('/', $path);
        $slug = $slug_tab[0];
        
        $menu = Menu::where('slug', $slug)->first();
        
        $elementModel = new Element;
        $element = $elementModel->getElement($element_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        
        $catModel = new Category;
        $product_categories = $catModel->getElementCategories($element_id);
        
        $tagModel = new Tag;
        $product_tags = $tagModel->getElementTags($element_id);
        
        $orderModel = new Order;
        $is_bought = $orderModel->checkUserOrder(Auth::id(), $element_id);
        
        $commentModel = new Comment;
        $comments = $commentModel->getCommentsByElement($element_id, 0, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        foreach($comments as $key=>$comm) {
                $comments_l2 = $commentModel->getCommentsByElement($element_id, $comm->comm_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
                if(!empty($comments_l2)) {
                    $comments[$key]->has_children = true;
                    $comments[$key]->children = $comments_l2;
                }
                else $comments[$key]->has_children = false;
        }
                
        $argumentModel = new ElementArgument;
        $arguments = $argumentModel->getArgumentsByElement($element_id);
        
        return view('front.element', array(
                                        'menu' => $menu, 
                                        'element' => $element, 
                                        'product_categories' => $product_categories, 
                                        'product_tags' => $product_tags,
                                        'is_bought' => $is_bought,
                                        'comments' => $comments,
                                        'arguments' => $arguments
                                    ));
    }
}
