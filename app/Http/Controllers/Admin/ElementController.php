<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Element;
use App\Models\ElementTag;
use App\Models\Tag;
use App\Models\Category;
use App\Models\ElementCategory;
use App\Models\MenuAttribute;
use Illuminate\Support\Str;
 
class ElementController extends Controller
{
    public function index($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        $elementModel = new Element;
        $elements = $elementModel->getBySlug($slug);
        return view('admin.element', ['menu' => $menu, 'elements' => $elements]);
    }
    
    public function create($slug) {
        $menu = Menu::where('slug', $slug)->first();
        $element_attributes =  new MenuAttribute;
        $attributes = $element_attributes->getAttributesByMenuSlug($slug);
        $categories = Category::where('active', 1)->get();
        return view('admin.forms.element', ['menu' => $menu, 'attributes' => $attributes, 'categories' => $categories, 'checked' => array()]);
    }
    
    public function edit($slug, $id) {
        $menu = Menu::where('slug', $slug)->first();
        $elementModel = new Element;
        $element = $elementModel->getElement($id);
        $element->product_categories = explode(',', $element->product_categories);
        
        
        $element_attributes =  new MenuAttribute;
        $attributes = $element_attributes->getAttributesByMenuSlug($slug);
     
        $categories = Category::where('active', 1)->get();
        
        return view('admin.forms.element', ['menu' => $menu, 'attributes' => $attributes, 'element' => $element, 'categories' => $categories]);
    }
    
    public function store(Request $request, $slug): RedirectResponse
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $element = new Element;
        $element->title = $request->title;
        $element->slug = Str::slug($request->name, "-");
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->is_new = (int)$request->is_new;
        $element->is_hot = (int)$request->is_hot;
        $element->user_id = 1;
        $element->menu_id = $menu->menu_id;
        $element->author = $request->author;
        $element->price = (float)$request->price;
        $element->vat = (float)$request->vat;
        $element->stock_quantity = (int)$request->stock_quantity;
        $element->discount = (float)$request->discount;
        $element->in_sale = (int)$request->in_sale;
        $element->publish_date = $request->publish_date;
        $element->save();
        $element_id = $element->element_id;
        
        if(!empty($request->tags)) {
           $tags = json_decode($request->tags);
           foreach($tags as $tag) {
               $cat = Tag::where('name', $tag->value)->where('active', 1)->first();
               if(!empty($cat)) {
                   $cat_id = $cat->tag_id;
               }
               else {
                   $cat_add = new Tag;
                   $cat_add->name = $tag->value;
                   $cat_add->active = 1;
                   $cat_add->save();
                   $cat_id = $cat_add->tag_id;
               }

               $tag_add = new ElementTag;  
               $tag_add->element_id = $element_id;
               $tag_add->tag_tag_id = $cat_id;
               $tag_add->save();
           }
       }
       
       if(!empty($request->product_categories)) {
           foreach($request->product_categories as $category=>$state) {
               if($state == 'on') {
                    $cat_add = new ElementCategory;  
                    $cat_add->element_element_id = $element_id;
                    $cat_add->category_cat_id = $category;
                    $cat_add->save();
               }
           }
       }

       return redirect('/admin/element/'.$slug);
    }
    
    public function update(Request $request, $slug, $id): RedirectResponse
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $element = Element::find($id);
        $element->title = $request->title;
        $element->slug = Str::slug($request->name, "-");
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->is_new = (int)$request->is_new;
        $element->is_hot = (int)$request->is_hot;
        $element->user_id = 1;
        $element->menu_id = $menu->menu_id;
        $element->author = $request->author;
        $element->price = (float)$request->price;
        $element->vat = (float)$request->vat;
        $element->stock_quantity = (int)$request->stock_quantity;
        $element->discount = (float)$request->discount;
        $element->in_sale = (int)$request->in_sale;
        $element->publish_date = $request->publish_date;
        $element->save();
        
        //najpierw usuwamy dotychczasowe tagi
        ElementTag::where('element_id', $id)->delete();
        
        //a następnie je dodajemy
        if(!empty($request->tags)) {
           $tags = json_decode($request->tags);
           foreach($tags as $tag) {
               $cat = Tag::where('name', $tag->value)->where('active', 1)->first();
               if(!empty($cat)) {
                   $cat_id = $cat->tag_id;
               }
               else {
                   $cat_add = new Tag;
                   $cat_add->name = $tag->value;
                   $cat_add->active = 1;
                   $cat_add->save();
                   $cat_id = $cat_add->tag_id;
               }

               $tag_add = new ElementTag;  
               $tag_add->element_id = $id;
               $tag_add->tag_tag_id = $cat_id;
               $tag_add->save();
           }
       }
       
       //najpierw usuwamy dotychczasowe kategorie
        ElementCategory::where('element_element_id', $id)->delete();
       
       if(!empty($request->product_categories)) {
           foreach($request->product_categories as $category=>$state) {
               if($state == 'on') {
                    $cat_add = new ElementCategory;  
                    $cat_add->element_element_id = $id;
                    $cat_add->category_cat_id = $category;
                    $cat_add->save();
               }
           }
       }

       return redirect('/admin/element/'.$slug);
    }
    
    public function remove($slug, $id) {
        $element = Element::find($id);
        $element->delete();
        
        return redirect('/admin/element/'.$slug);
    }
    
    public function upload_file() {
        $random = Str::random(15);
        $uploads_dir = env('ELEMENTS_IMAGES_URL');
        $tmp_name = $_FILES["croppedImage"]["tmp_name"];
        if(move_uploaded_file($tmp_name, "$uploads_dir/$random.png")) echo $random.'.png';
    }
}
