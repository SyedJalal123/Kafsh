<?php

use App\Models\Product;
use App\Models\Order;


function get_product_data($id){
    $product = Product::where('id',$id)->with('variations')->first();
    return $product;
}
function active_orders_count(){
    $orders = Order::where('status','unfulfilled')->get();
    return count($orders);
}