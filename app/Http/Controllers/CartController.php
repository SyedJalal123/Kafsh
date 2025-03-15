<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Collection;
use App\Models\Cart;
use App\Models\Page;
use App\Mail\OrderMail;
use App\Mail\OrderMailCustomer;
use Artisan;
use Session;

class CartController extends Controller
{
    public function index () {
        // Session::flush(); 
        // dd(session()->get('order_session'));
        $cart_page = 1;
        if(auth()->user() !== null){
            $carts = Cart::where('customer_id',auth()->user()->id)->orderBy('id','Desc')->get();
        }else{
            $carts = [];
        }

        $p = Page::where('slug','cart')->first();
        views($p)->collection(\Request::ip())->record();
        
        return view('frontend.cart',compact('carts','cart_page'));
    }
    public function thank_you($id) {
        $order = Order::find($id);
        return view('frontend.thank-you',compact('order'));
    }
    public function store (Request $request) {
        // Artisan::call('config:cache');
        // Artisan::call('cache:clear');
        // // Artisan::call('queue:work');
        // dd($request->all());
        $last_order = Order::orderBy('id','desc')->first();
        if($last_order == null){
            $o_no = 1000;
        }else{
            $o_no = (int)$last_order->order_no;
        }

        $order = new Order;
        if(auth()->user() !== null){
            $order->customer_id = auth()->user()->id;
        }
        $order->order_no = $o_no + 1;

        $product_array = [];
        foreach($request->product_id as $key => $product_id){
            $product_array[$request->product_id[$key]][$request->product_variation_value[$key]] = [
                'id' => $request->product_id[$key],
                'variation_title' => $request->product_variation_title[$key],
                'variation_value' => $request->product_variation_value[$key],
                'quantity' => $request->product_quantity[$key],
                'price' => $request->product_price[$key],
                'sub_total' => $request->product_sub_total[$key]
            ];
        }

        $order->product = $product_array;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->whatsapp = $request->whatsapp;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->total = $request->total;
        $order->save();

        $customer = Customer::where('email',$request->email)->first();
        if($customer == null){
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->whatsapp = $request->whatsapp;
            $customer->address = $request->address;
            $customer->city = $request->city;
            $customer->save();
        }else{
            if($customer->city == null){
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->whatsapp = $request->whatsapp;
                $customer->address = $request->address;
                $customer->city = $request->city;
                $customer->save();
            }
        }

        if(auth()->user() == null){
            foreach($request->product_id as $key => $product){
                $product_arr = explode('-', $product);
                $cart = session()->get('cart');
                if (isset($cart[$request->product_id[$key]][$request->product_variation_value[$key]])) {
    
                    unset($cart[$request->product_id[$key]][$request->product_variation_value[$key]]);
                    if(count($cart[$request->product_id[$key]]) == 0){
                        unset($cart[$request->product_id[$key]]);
                    }
        
                    session()->put('cart', $cart);
                }
            }
        }else {
            foreach($request->product_id as $key => $product){
                $product_arr = explode('-', $product);
                $cart = Cart::where('product_id', $request->product_id[$key])->where('variation_value', $request->product_variation_value[$key])->where('customer_id', auth()->user()->id)->first();
                if ($cart != null) {
                    $cart->delete();
                }
            }
        }

        $order = Order::orderBy('id','desc')->first();
        if(auth()->user() == null){
            $order_session = session()->get('order_session');
            if (!$order_session) {
                $order_session = [$order->id];
                session()->put('order_session', $order_session);
            }else{
                array_push($order_session, $order->id);
                session()->put('order_session', $order_session);
            }
        }

        $request->request->add(['order' => $order]);
        // dd($request);
        $this->order_email($request);

        return redirect()->route('thank-you', [$order->id]);
    }
    public function addToCart(Request $request){
        // dd($request->all());
        
        if(auth()->user() == null){
            $cart = session()->get('cart');
            // dd($cart);
            if (!$cart) {
                $cart = [
                    $request['id'] => [
                        $request['variation'][1] => $this->sessionData($request)
                    ]
                ];
                // dd($cart);
                session()->put('cart', $cart);
            }elseif (isset($cart[$request['id']][$request['variation'][1]])) {
                $cart[$request['id']][$request['variation'][1]]['quantity'] = (int)$cart[$request['id']][$request['variation'][1]]['quantity'] + (int)$request['quantity'];
                // $cart[$request['id']][$request['sub_total']] = (int)$request['price'] * ((int)$request['quantity'] + (int)$cart[$request['id']][$request['variation'][1]]['quantity']);
                $cart[$request['id']][$request['variation'][1]]['sub_total'] = (int)$request['price'] * (int)$cart[$request['id']][$request['variation'][1]]['quantity'];
                session()->put('cart', $cart);
            }else{
                $cart[$request['id']][$request['variation'][1]] = $this->sessionData($request);
                session()->put('cart', $cart);
            }
    
            return Session::get('cart');
        }else{
            // dd($product_array);
            $cart = Cart::where('customer_id',auth()->user()->id)->where('product_id',$request['id'])->where('variation_value',$request['variation'][1])->first();
            // dd($cart);
            if ($cart == null) {
                $cart = new Cart;
                $cart->customer_id = auth()->user()->id;
                $cart->product_id = $request['id'];
                $cart->variation_title = $request['variation'][0];
                $cart->variation_value = $request['variation'][1];
                $cart->quantity = 1;
                $cart->price = $request['price'];
                $cart->sub_total = (int)$request['price'];
                $cart->save();

                $cart->save();
                $cart = Cart::orderBy('id','Desc')->first();
                return $cart;
            }else{
                $cart->quantity = (int)$cart->quantity + (int)$request['quantity'];
                $cart->sub_total = ((int)$cart->quantity + (int)$request['quantity']) * (int)$request['price'];
                $cart->save();

                $cart = Cart::where('customer_id',auth()->user()->id)->where('product_id',$request['id'])->where('variation_value',$request['variation'][1])->first();
                return $cart;
            }

        }
    }
    public function removeFromCart($id,$variation,$modal_value){
        // dd($modal_value);

        if(auth()->user() == null){
            $cart = session()->get('cart');
            if (isset($cart[$id][$variation])) {
    
                unset($cart[$id][$variation]);
                if(count($cart[$id]) == 0){
                    unset($cart[$id]);
                }
    
                session()->put('cart', $cart);
            }
        }else {
            $cart = Cart::where('customer_id',auth()->user()->id)->where('product_id',$id)->where('variation_value',$variation)->first();
            if ($cart != null) {
                $cart->delete();            
            }
        }

        return back()->with('modal_value',$modal_value);
    }
    public function change_qty(Request $request){
        // dd($request->all());
        if($request->quantity == 0){
            if(auth()->user() == null){
                $cart = session()->get('cart');
                if (isset($cart[$request['ids'][0]][$request['ids'][1]])) {
        
                    unset($cart[$request['ids'][0]][$request['ids'][1]]);
                    if(count($cart[$request['ids'][0]]) == 0){
                        unset($cart[$request['ids'][0]]);
                    }
        
                    session()->put('cart', $cart);
                }
            }else {
                $cart = Cart::where('customer_id',auth()->user()->id)->where('product_id',$request['ids'][0])->where('variation_value',$request['ids'][1])->first();
                if ($cart != null) {
                    $cart->delete();            
                }
            }
        }else{
            if(auth()->user() == null) {
                $cart = session()->get('cart');
                $cart[$request['ids'][0]][$request['ids'][1]]['quantity'] = $request['quantity'];
                $cart[$request['ids'][0]][$request['ids'][1]]['sub_total'] = (int)$request['quantity'] * (int)$cart[$request['ids'][0]][$request['ids'][1]]['price'];
                session()->put('cart', $cart);
        
                return "success";
            }else{
                $cart = Cart::where('customer_id',auth()->user()->id)->where('product_id',$request['ids'][0])->where('variation_value',$request['ids'][1])->first();

                $cart->quantity = (int)$request['quantity'];
                $cart->sub_total = (int)$request['quantity'] * (int)$cart->price;
                $cart->save();

                return "success";
            }
        }
    }
    public function newsletter(Request $request){
        $customer = Customer::where('email',$request->email)->first();

        if($customer == null){
            $customer = new Customer;
            $customer->name = explode('@', $request->email)[0];
            $customer->email = $request->email;
            $customer->save();
        }

        Session::flash('success-subscribed', 'Subscribed');
        return redirect()->back();
    }
    public function search_data(Request $request){
        $products = Product::where('title','LIKE','%'.$request->val.'%')->get();
        $collections = Collection::where('title','LIKE','%'.$request->val.'%')->get();
        return [$products, $collections];
    }
    protected function sessionData($product){
        // dd($product['images'][0]);
        return [
            'id' => $product['id'],
            'name' => $product['title'],
            'quantity' => 1,
            'price' => $product['price'],
            'sub_total' => (int)$product['price'],
            'image' => $product['image'],
            'variation_title' => $product['variation'][0],
            'variation_value' => $product['variation'][1],
        ];
    }
    protected function order_email(Request $request){
        // dd($request->all());
        Mail::to($request->email)->send(new OrderMailCustomer());
        Mail::to('kafshwearings@gmail.com')->send(new OrderMail());

        return redirect()->back()->with('success','Order Confirmed!');
    }
}
