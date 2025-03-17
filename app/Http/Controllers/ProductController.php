<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Collection;
use App\Models\Variation;
use App\Models\Page;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $collections = Collection::all();
        return view('backend.product', compact('products','collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $product = new Product;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->collections = $request->collections;
        $product->tags = $request->tags;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->slug = $request->slug;
        if($request->status){
            $product->status = 1;
        }else{
            $product->status = 0;
        }
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        
        $gallery_images = [];
        foreach($request->images as $key => $image){
            $images_Name = time() . '.' . rand(1, 99999) . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image->move(public_path('frontend/product_images'), $images_Name);
            array_push($gallery_images,'frontend/product_images/'.$images_Name);
        }
        $product->images = $gallery_images;
        $product->save();

        $latest_product = Product::orderBy('id','Desc')->first();
        foreach($request->variation_title as $key => $title){
            if($title != null){
                $variation = new Variation;
                $variation->product_id = $latest_product->id;
                $variation->title = $title;
                $variation->value = $request->variation_value[$key];
                $variation->price = $request->variation_price[$key];
                $variation->quantity = $request->variation_quantity[$key];
                $variation->save();
            }
        }
        

        return redirect()->back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id',$id)->with('variations')->first();
        $collections = Collection::all();
        return view('backend.edit-product',compact('product','collections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $product = Product::find($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->collections = $request->collections;
        $product->tags = $request->tags;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->slug = $request->slug;

        if($request->status){
            $product->status = 1;
        }else{
            $product->status = 0;
        }
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        
        $gallery_images = [];
        if(isset($request->old_images)){
            foreach($request->old_images as $key => $image){
                array_push($gallery_images, $image);
            }
        }
        if(isset($request->images)){
            foreach($request->images as $key => $image){
                $images_Name = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('frontend/product_images'), $images_Name);
                
                $gallery_images[$key] = 'frontend/product_images/'.$images_Name;
    
                if(isset($request->old_images[$key])){
                    if(file_exists(public_path($request->old_images[$key])))
                    unlink(public_path($request->old_images[$key]));
                }
            }
        }
        
        $product->images = $gallery_images;
        $product->save();

        $variations_del = Variation::where('product_id',$id)->get();
        $variations_del->each->delete();

        foreach($request->variation_title as $key => $title){
            if($request->variation_value[$key] != null){
                $variation = new Variation;
                $variation->product_id = $id;
                $variation->title = $title;
                $variation->value = $request->variation_value[$key];
                $variation->price = $request->variation_price[$key];
                $variation->quantity = $request->variation_quantity[$key];
                $variation->save();
            }
        }
        

        return redirect()->back()->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
