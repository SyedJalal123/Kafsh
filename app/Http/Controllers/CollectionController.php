<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return view('backend.collection', compact('collections'));
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

        $collection = new Collection;
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('frontend/collection'), $imageName);

            $collection->image = 'frontend/collection/'.$imageName;
        }

        $collection->title = $request->title;
        if($request->status){
            $collection->status = 1;
        }else{
            $collection->status = 0;
        }
        $collection->seo_title = $request->seo_title;
        $collection->seo_description = $request->seo_description;
        $collection->save();


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
        $collection = Collection::find($id);
        return view('backend.edit-collection',compact('collection'));
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

        $collection = Collection::find($id);
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('frontend/collection'), $imageName);

            if(file_exists(public_path($request->old_image)))
            unlink(public_path($request->old_image));

            $collection->image = 'frontend/collection/'.$imageName;
        }

        $collection->title = $request->title;
        if($request->status){
            $collection->status = 1;
        }else{
            $collection->status = 0;
        }
        $collection->seo_title = $request->seo_title;
        $collection->seo_description = $request->seo_description;
        $collection->save();


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
