<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Tag;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        $elementModel = new Element;
        $elements = $elementModel->getByMenuId($menu->menu_id);
        $tagsModel = new Tag;
        $tags_space = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'tag');
        $tags_region = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'region');
        $tags_tags = $tagsModel->getByMenuIdAndGroup($menu->menu_id, 'space');
        return view('front.home', array('menu' => $menu, 'elements' => $elements, 'tags_tags' => $tags_tags, 'tags_region' => $tags_region, 'tags_space' => $tags_space));
    }
}
