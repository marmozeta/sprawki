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
use App\Models\Setting;
use App\Models\ElementUserLog;

class HomeController extends Controller
{
    public function __construct() {
        $this->commentModel = new Comment;
    }
    public function index()
    {
        $slug = request()->path();
        $menuModel = new Menu;
        $menu = $menuModel->getMenuBySlug($slug);
        $elementModel = new Element;
        $request_tag = request()->get('tag');
        $elements = $elementModel->getByMenuId($menu->menu_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp(), $request_tag);
        
        $tagsModel = new Tag;
        $tags_space = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'space');
        $tags_region = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'region');
        $tags_tags = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'tag');
        
        $hot_comments = Setting::where('name', 'comment_counter')->first()->value;
        $hot_likes = Setting::where('name', 'like_counter')->first()->value;
        
        $ad_element = Element::where('menu_id', 9)->first();
        
        $view = ($menu->is_social) ? 'social' : 'home'; 
        return view('front.'.$view, 
                array('menu' => $menu, 
                    'elements' => $elements, 
                    'tags_tags' => $tags_tags, 
                    'tags_region' => $tags_region, 
                    'tags_space' => $tags_space, 
                    'hot_comments' => $hot_comments, 
                    'hot_likes' => $hot_likes,
                    'ad_element' => $ad_element)
                );
    }
    
    public function show($element_id, $element_slug)
    {
        if(Auth::check()) {
            $is_read = ElementUserLog::where('user_id', Auth::user()->id)->where('element_id', $element_id)->first();
            if(empty($is_read)) {   
                $log = new ElementUserLog;
                $log->user_id = Auth::user()->id;
                $log->element_id = $element_id;
                $log->save();
            }
        }
        
        $path = request()->path();
        $slug_tab = explode('/', $path);
        $slug = $slug_tab[0];
        
        $menu = Menu::where('slug', $slug)->first();
        
        $elementModel = new Element;
        $element = $elementModel->getElement($element_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        $intro = "Wartościowy materiał na sprawki.pl: ";
        $element->text_for_social = $intro.str_replace('%', 'percent', $element->title);
        
        $catModel = new Category;
        $product_categories = $catModel->getElementCategories($element_id);
        
        $tagModel = new Tag;
        $product_tags = $tagModel->getElementTags($element_id);
        
        $orderModel = new Order;
        $is_bought = $orderModel->checkUserOrder(Auth::id(), $element_id);
        
        $is_in_cart = false;
        $cart_content = Cart::content();
        foreach($cart_content as $row) {
            if($row->id == $element_id) $is_in_cart = true;
        }
        
        $comments = $this->_build_comments_tree($element_id, 0);
         
        $argumentModel = new ElementArgument;
        $arguments = $argumentModel->getArgumentsByElement($element_id);
        
        $hot_comments = Setting::where('name', 'comment_counter')->first()->value;
        $hot_likes = Setting::where('name', 'like_counter')->first()->value;
        
        $ad_element = Element::where('menu_id', 9)->first();
           
        return view('front.element', array(
                                        'menu' => $menu, 
                                        'element' => $element, 
                                        'product_categories' => $product_categories, 
                                        'product_tags' => $product_tags,
                                        'is_bought' => $is_bought,
                                        'is_in_cart' => $is_in_cart,
                                        'comments' => $comments,
                                        'arguments' => $arguments, 
                                        'hot_comments' => $hot_comments, 
                                        'hot_likes' => $hot_likes,
                                        'ad_element' => $ad_element));
    }
    
    private function _build_comments_tree($element_id, $parent_id) {
        $comments = $this->commentModel->getCommentsByElement($element_id, $parent_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
        foreach($comments as $key=>$comm) {
                $comments_l2 = $this->commentModel->getCommentsByElement($element_id, $comm->comm_id, (Auth::check()) ? Auth::user()->id : 0, request()->getClientIp());
                if(!empty($comments_l2)) {
                    $comments[$key]->has_children = true;
                    $comments[$key]->children = $this->_build_comments_tree($element_id, $comm->comm_id);
                }
                else $comments[$key]->has_children = false;
        }
        return $comments;
    }
}
