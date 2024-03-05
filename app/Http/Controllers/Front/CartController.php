<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Element;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderCompleted;
use App\Models\MediaUpload;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
        
    public function cart() {
        $tax = 0;
        
        $cart_content = Cart::content();
        foreach($cart_content as $rowId => $row) {
            $product_id = $row->id;
            $quantity = $row->qty;
            $product = Element::find($product_id);
            $price = $row->price;
            $vat = $product->vat;
            $price_from_db = $product->price;
            $row_id = $row->rowId;
            
            if($price <> $price_from_db) {
                Cart::update((string)$row_id, ['price' => $price_from_db]);
            }
            
            $tax += round(($price_from_db/(100+$vat)*$vat)*$quantity, 2);
            $cart_content[$rowId]->is_virtual = $product->is_virtual;
        }

        return view('front.cart', array('tax' => $tax, 'cart_content' => $cart_content));
    }
    
    public function checkout() {
        if((int)Cart::total() == 0) return redirect(route('front.cart'));
        
        $name = (Auth::user()) ? explode(' ', Auth::user()->name) : array('', '');
        
        return view('front.checkout', array('firstname' => $name[0], 'lastname' => $name[1]));
    }
    
    public function add_to_cart(Request $request)
    {
        $element = Element::find($request->element_id);
        $in_cart = false;
        
        //sprawdzamy czy produkt jest wirtualny, jeśli tak to czy już jest w koszyku
        if($element->is_virtual) {
            foreach(Cart::content() as $cartItem) {
                if($cartItem->id == $request->element_id) {
                    $in_cart = true;
                }
            };
        }
        
        if(!$in_cart)
            $cart = Cart::add((string)$request->element_id, (string)$element->title, (int)$request->quantity, (float)$element->price, ['image' => $element->image]);
        else 
            $cart = 'already_in_cart';
        
        return response($cart, 200); 
    }
    
    public function update_quantity(Request $request)
    {
        $quantity = (int)$request->quantity;
        if($quantity > 0) {
            Cart::update((string)$request->row_id, $quantity);
            $result = array(Cart::count(), Cart::get((string)$request->row_id)->total, Cart::subtotal(), Cart::tax(), Cart::total());
            return response($result, 200); 
        }
        else {
            return $this->remove_product($request);
        }
    }
    
    public function remove_product(Request $request)
    {
        Cart::remove((string)$request->row_id);
        $result = array(Cart::count(), 0, Cart::subtotal(), Cart::tax(), Cart::total());    
        return response($result, 200); 
    }
    
    public function process(Request $request) 
    {
        if((int)Cart::total() == 0) return redirect(route('front.cart'));
        
        //zakładamy zamówienie
        $order = new Order();
        if(!empty(Auth::id())) $order->user_id = Auth::id();
        $order->email = $request->email;
        $order->firstname = $request->firstname;
        $order->lastname = $request->lastname;
        $order->comments = $request->comments;
        $order->save();
        $crc = $order->id;
        
        foreach(Cart::content() as $row_item) {
            $order_item = new OrderItem();
            $order_item->order_id = $crc;
            $order_item->element_element_id = $row_item->id;
            $order_item->price = $row_item->price;
            $order_item->quantity = $row_item->qty;
            $order_item->save();
        }
        
        //przekierowanie do Tpay
        $id = env("TPAY_CLIENT_ID");
        $amount = Cart::total();
        $code = env("TPAY_SECURITY_CODE");
        $email = $request->email;
        $name = $request->firstname.' '.$request->lastname;
        $result_url = url('/').'/public/transaction_receive.php';
        $return_url = url('/').'/sklep/zamowienie/podziekowanie/'.$order->id;
        $return_error_url = url('/').'/sklep/zamowienie/blad/'.$order->id;
        
        //usunięcie koszyka
        Cart::destroy();
         
        $md5sum = md5($id.'&'.$amount.'&'.$crc.'&'.$code);
        $link = "https://secure.tpay.com?id={$id}&amount={$amount}&description=test&crc={$crc}&email={$email}&name={$name}&result_url={$result_url}&return_url={$return_url}&return_error_url={$return_error_url}&md5sum={$md5sum}";
        return redirect($link);
    }
    
    public function thank_you($order_id) {
        $order = Order::find($order_id);
        Mail::to($order->email)->send(new OrderCompleted($order));
        return view('front.thank_you', array('order' => $order));
    }
    
    public function order_error($order_id) {
        $order = Order::find($order_id);
        return view('front.order_error', array('order' => $order));
    }
    
    public function transaction_receive($order_id, $tr_id, $status, $error) {   
        $order = Order::find($order_id);
        $order->status = $status;
        $order->error = $error;
        if(!empty($tr_id)) {$order->payment_token = $tr_id;}
        $order->save();
             
        if ($status=='TRUE' && $error=='none') {
            $allOk = true;
        
            if ($allOk) {
                Mail::to($order->email)->send(new OrderCompleted($order));
                return "TRUE";
            } else {
                return "FALSE";
            }
        } else {
            Mail::to($order->email)->send(new OrderCompleted($order));
            return "TRUE";
        }
    }
    
    public function get_files(Request $request) {
        $element = Element::find($request->element_id);
        
        $mediaModel = new MediaUpload();
        $media = $mediaModel->getMediaForElement($request->element_id);
        if(count($media) == 0) {
            return back()->withInput();
        }
        elseif(count($media) > 1) {
            $zipFileName = $element->slug.'_'.Auth::id().'.zip';
            unlink(public_path('media').'/'.$zipFileName);
            $zip = new ZipArchive();
            
            if ($zip->open(public_path('media').'/'.$zipFileName, ZipArchive::CREATE) === TRUE) {
                if(!empty($media)) {
                    foreach($media as $med) {
                        $file =  public_path('media').'/'.$med->filename;
                        $zip->addFile($file, basename($file));
                    }
                }

                $zip->close();

            }

            $headers = array(
                  'Content-Type: application/zip',
                );

            return Response::download(public_path('media').'/'.$zipFileName, $zipFileName, $headers);
        }
        else {
            $file =  public_path('media').'/'.$media[0]->filename;
            $content_type = mime_content_type($file);
            
             $headers = array(
                  'Content-Type: '.$content_type,
                );
             
            return Response::download($file, $media[0]->filename, $headers);
        }
    }
    
    public function get_files_by_order(Request $request) {
        $media = array();
        $mediaModel = new MediaUpload();
        $order_items = OrderItem::where('order_id', $request->order_id)->get();
        if(!empty($order_items)) {
            foreach($order_items as $oi) {       
                $media_for_element = $mediaModel->getMediaForElement($oi->element_element_id);
                if(!empty($media_for_element)) {
                    foreach($media_for_element as $m) {
                        $media[] = $m;
                    }   
                }
        }}
          
        $zipFileName = $request->order_id.'_'.Auth::id().'.zip';
        if(file_exists(public_path('media').'/'.$zipFileName)) unlink(public_path('media').'/'.$zipFileName);
        $zip = new ZipArchive();
        
        if(count($media) == 0) {
            return back()->withInput();
        }
        elseif(count($media) > 1) {
            if ($zip->open(public_path('media').'/'.$zipFileName, ZipArchive::CREATE) === TRUE) {
                if(!empty($media)) {
                    foreach($media as $med) {
                        $file =  public_path('media').'/'.$med->filename;
                        $zip->addFile($file, basename($file));
                    }
                }

                $zip->close();
            }
            
            $headers = array(
                  'Content-Type: application/zip',
                );

            return Response::download(public_path('media').'/'.$zipFileName, $zipFileName, $headers);
        }
        else {
            $file =  public_path('media').'/'.$media[0]->filename;
            $content_type = mime_content_type($file);
            
             $headers = array(
                  'Content-Type: '.$content_type,
                );
             
            return Response::download($file, $media[0]->filename, $headers);
        }
    }
}
