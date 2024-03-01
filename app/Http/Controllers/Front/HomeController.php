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
        $menuModel = new Menu;
        $menu = $menuModel->getMenuBySlug($slug);
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
        $intro = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ornare tempus vestibulum. Etiam suscipit nisi sed mi pharetra, at egestas metus vestibulum. Mauris sed metus consectetur, faucibus est a, elementum quam. Cras sit amet nunc ut leo ornare facilisis ut a arcu. Aliquam ex eros, consectetur et massa a, vehicula pellentesque dolor. Nulla mollis nisi quis purus ornare efficitur. Duis eleifend odio vitae aliquet dictum. Donec quis metus in ipsum laoreet lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis viverra dignissim ante eu lacinia. Nam eu ultrices nisl. Aenean a vestibulum elit. Nullam non neque sed augue aliquet volutpat. Pellentesque volutpat, erat a tempus rhoncus, lorem dui ornare felis, ac lobortis nulla justo in tellus. Vivamus finibus magna augue, vel iaculis nisl lobortis vitae. Quisque id sodales eros.";
        $element->text_for_social = $intro.$element->title;
        
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
