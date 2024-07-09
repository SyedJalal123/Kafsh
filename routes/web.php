<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Collection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // dd(views(Product::class)->count());
    $products = Product::with('variations')->get();
    $collections = Collection::all();
    $home = 1;

    // $p = Product::withTrashed()->get();
    // views($p[2])->collection('Home')->record();

    return view('frontend.home_',compact('products','home','collections'));
});
Route::get('/about-us', function () {
    return view('frontend.about-us');
});
Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});
Route::get('/refund-policy', function () {
    return view('frontend.refund-policy');
});
Route::get('/terms-conditions', function () {
    return view('frontend.terms-conditions');
});
Route::get('/collection', function () {
    $collections = Collection::all();
    return view('frontend.collections',compact('collections'));
});
Route::get('products/{slug}', function ($slug) {
    $product_page = 1;
    $product = Product::where('slug',$slug)->with('variations')->first();
    // views($product)->collection('product')->record();
    $products = Product::with('variations')->get();
    if(auth()->user() !== null){
        $carts = Cart::where('customer_id',auth()->user()->id)->orderBy('id','Desc')->get();
    }else{
        $carts = [];
    }
    
    return view('frontend.product',compact('product','carts','product_page','products'));
});
Route::get('collections/{collection}', function ($collection_slug) {
    $collection_page = 1;
    $min = null;
    $max = null;
    $sort = null;
    if($collection_slug == 'all'){
        $products = Product::with('variations')->get();
        $collection = null;
    }else{
        $collection = Collection::where('slug',$collection_slug)->first();
        $products = Product::where('collections','LIKE', "%".$collection->title."%")->with('variations')->get();
    }

    return view('frontend.collection',compact('collection_page','collection','collection_slug','products','min','max','sort'));
});
Route::get('collections', function (Request $request) {
    $collection_page = 1;
    $collection_slug = $request->collection_slug;
    $min = $request->min;
    $max = $request->max;
    $sort = $request->sort;

    if($sort == 'newest'){
        $sort_column = 'created_at';
        $sort_value = 'asc';
    }else if($sort == 'price-descending'){
        $sort_column = 'price';
        $sort_value = 'desc';
    }else if($sort == 'price-ascending') {
        $sort_column = 'price';
        $sort_value = 'asc';
    }
    
    if($collection_slug != 'all'){
        $collection = Collection::where('slug',$request->collection_slug)->first();
        if($min !== null && $sort !== null){
            $products = Product::where('collections','LIKE', "%".$collection->title."%")->where('price','>=',$request->min)->where('price','<=',$request->max)->orderBy($sort_column,$sort_value)->with('variations')->get();
        }else if($min == null && $sort != null){
            $products = Product::where('collections','LIKE', "%".$collection->title."%")->orderBy($sort_column,$sort_value)->with('variations')->get();
        }else if($sort == null && $min != null){
            $products = Product::where('collections','LIKE', "%".$collection->title."%")->where('price','>=',$request->min)->where('price','<=',$request->max)->with('variations')->get();
        }else if($min == null && $sort == null){
            $products = Product::where('collections','LIKE', "%".$collection->title."%")->with('variations')->get();
        }
    }else{
        if($min !== null && $sort !== null){
            $products = Product::where('price','>=',$request->min)->where('price','<=',$request->max)->orderBy($sort_column,$sort_value)->with('variations')->get();
        }else if($min == null && $sort != null){
            $products = Product::orderBy($sort_column,$sort_value)->with('variations')->get();
        }else if($sort == null && $min != null){
            $products = Product::where('price','>=',$request->min)->where('price','<=',$request->max)->with('variations')->get();
        }else if($min == null && $sort == null){
            $products = Product::with('variations')->get();
        }
        $collection = null;
    }

    return view('frontend.collection',compact('collection_page','collection','products','collection_slug','min','max','sort'));
});
Route::get('/sign-up', function () {
    return view('frontend.signup');
});
Route::get('/sign-in', function () {
    return view('frontend.login');
})->name('sign-in');
Route::get('/account', function () {
    $orders = Order::where('customer_id', auth()->user()->id)->orderBy('id','Desc')->get();
    return view('frontend.account',compact('orders'));
})->name('account')->middleware('front_auth');

Route::post('/sign-up', [App\Http\Controllers\SignupController::class, 'register'])->name('sign-up');
Route::post('/sign-in', [App\Http\Controllers\SignupController::class, 'login'])->name('sign-in');

Route::post('/addToCart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::post('/change_qty', [App\Http\Controllers\CartController::class, 'change_qty'])->name('change_qty');
Route::get('/remove_from_cart/{id}/{variation}/{modal_value}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('remove_from_cart');
Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart');
Route::post('newsletter', [App\Http\Controllers\CartController::class, 'newsletter'])->name('newsletter');
Route::post('search_data', [App\Http\Controllers\CartController::class, 'search_data'])->name('search_data');
// Route::post('order_email',[App\Http\Controllers\CartController::class, 'order_email'])->name('order_email');

Route::get('thank-you/{id}', [App\Http\Controllers\CartController::class, 'thank_you'])->name('thank-you');



Auth::routes();




Route::middleware('auth','back_auth')->group(function(){
    Route::prefix('backend')->group(function(){
        
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('collection', CollectionController::class);
        Route::resource('product', ProductController::class);
        Route::resource('order', OrderController::class);
        Route::post('fullfill_orders', [App\Http\Controllers\OrderController::class, 'fullfill_orders'])->name('fullfill_orders');
        Route::resource('customer', CustomerController::class);

    });
});
