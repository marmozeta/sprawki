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
use App\Models\ElementMediaUpload;
use App\Models\MediaUpload;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
 
class ElementController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
        
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
        $element = $elementModel->getElementForEdit($id);
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
        $element->toptitle = $request->toptitle;
        $element->slug = ($menu->is_social) ? Str::random() : Str::slug($request->title, "-");
        $element->subtitle = $request->subtitle;
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->icon = $request->icon;
        if(!empty($request->flag)) {
            $flag = json_decode($request->flag);
            $element->flag = $flag[0]->code;
        }
        $element->country = $request->country;
        $element->is_new = ($request->is_new == 'on');
        $element->is_hot = ($request->is_hot == 'on');
        $element->user_id = Auth::user()->id;
        $element->menu_id = $menu->menu_id;
        $element->author_id = Auth::user()->id;
        if(!empty($request->author)) {
            $author = json_decode($request->author);
            $element->author = $author[0]->value;
            $author_user = User::where('friendly_name', $element->author)->first();
            if(!empty($author_user)) $element->author_id = $author_user->id;
            else $element->author_id = 0;
        }
        $element->price = (float)$request->price;
        $element->vat = (float)$request->vat;
        $element->stock_quantity = (int)$request->stock_quantity;
        $element->discount = (float)$request->discount;
        $element->in_sale = ($request->in_sale == 'on');
        $element->is_virtual = ($request->is_virtual == 'on');
        $element->publish_date = (empty($request->publish_date)) ? date('Y-m-d H:i:s') : $request->publish_date;
        $element->youtube = $request->youtube;
        $element->save();
        $element_id = $element->element_id;
       
       if(!empty($request->tag_tags)) {
           $tags = json_decode($request->tag_tags);
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
       
       if(!empty($request->region_tags)) {
           $tags = json_decode($request->region_tags);
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
       
       if(!empty($request->space_tags)) {
           $tags = json_decode($request->space_tags);
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
       
       //usuwamy i dodajemy pliki medialne
       ElementMediaUpload::where('element_element_id', $element_id)->delete();
       
       if(!empty($request->files_to_send)) {
           $files_to_send = explode(',', $request->files_to_send);
           foreach($files_to_send as $media_filename) {
                $media = MediaUpload::where('filename', $media_filename)->first();
                $media_add = new ElementMediaUpload;  
                $media_add->element_element_id = $element_id;
                $media_add->media_upload_id = $media->id;
                $media_add->save();     
           }
       }

       return redirect('/admin/element/'.$slug);
    }
    
    public function update(Request $request, $slug, $id): RedirectResponse
    {
        $menu = Menu::where('slug', $slug)->first();
        
        $element = Element::find($id);
        $element->title = $request->title;
        $element->toptitle = $request->toptitle;
        $element->slug = ($menu->is_social) ? Str::random() : Str::slug($request->title, "-");
        $element->subtitle = $request->subtitle;
        $element->image = $request->image;
        $element->description = $request->desc;
        $element->icon = $request->icon;
        if(!empty($request->flag)) {
            $flag = json_decode($request->flag);
            $element->flag = $flag[0]->code;
        }
        $element->country = $request->country;
        $element->is_new = ($request->is_new == 'on');
        $element->is_hot = ($request->is_hot == 'on');
        $element->user_id = Auth::user()->id;
        $element->menu_id = $menu->menu_id;
        $element->author_id = Auth::user()->id;
        if(!empty($request->author)) {
            $author = json_decode($request->author);
            $element->author = $author[0]->value;
            $author_user = User::where('friendly_name', $element->author)->first();
            if(!empty($author_user)) $element->author_id = $author_user->id;
            else $element->author_id = 0;
        }
        $element->price = (float)$request->price;
        $element->vat = (float)$request->vat;
        $element->stock_quantity = (int)$request->stock_quantity;
        $element->discount = (float)$request->discount;
        $element->in_sale = ($request->in_sale == 'on');
        $element->is_virtual = ($request->is_virtual == 'on');
        if(!empty($request->publish_date)) $element->publish_date = $request->publish_date;
        $element->youtube = $request->youtube;
        $element->save();
        
        //najpierw usuwamy dotychczasowe tagi
        ElementTag::where('element_id', $id)->delete();
        
        //a następnie je dodajemy
        if(!empty($request->tag_tags)) {
           $tags = json_decode($request->tag_tags);
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
       
       if(!empty($request->region_tags)) {
           $tags = json_decode($request->region_tags);
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
       
       if(!empty($request->space_tags)) {
           $tags = json_decode($request->space_tags);
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
       
       //usuwamy i dodajemy pliki medialne
       ElementMediaUpload::where('element_element_id', $id)->delete();
       
       if(!empty($request->files_to_send)) {
           $files_to_send = explode(',', $request->files_to_send);
           foreach($files_to_send as $media_filename) {
                $media = MediaUpload::where('filename', $media_filename)->first();
                $media_add = new ElementMediaUpload;  
                $media_add->element_element_id = $id;
                $media_add->media_upload_id = $media->id;
                $media_add->save();     
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
