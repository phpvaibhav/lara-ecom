<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use View,Redirect;
use App\Category;
use App\Http\Requests\StoreProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
class ProductController extends Controller
{
     public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['front_scripts'] = array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
        $products = Product::with('categories')->paginate(3);
        $data['products'] = $products;
       return View::make('backend_pages.products.index',$data);
    }
    /**
     * Display a trash listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $data['front_scripts'] = array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
        $products = Product::with('categories')->onlyTrashed()->paginate(3);
        $data['products'] = $products;
       return View::make('backend_pages.products.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['front_scripts'] = array('js/pages/crud/forms/widgets/select2.js'); //array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
         $categories = Category::all();
         $data['categories'] = $categories;
       return View::make('backend_pages.products.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $name = 'images/no-thumbnail.jpeg';
        $path = 'images/no-thumbnail.jpeg';
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = round(1111,9999999).'_'.time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images',$name,'public');
        }
        /*$extra = array(
            'option'=> isset($request->option) ? $request->option:null),
            'values'=> isset($request->values) ? $request->values:null),*/
        $product = Product::create([
            'title' => $request->title,
            'slug'  => $request->slug,
            'price'  => $request->price,
            'discount'  => isset($request->discount_price) ? 1:0,
            'discount_price'  => isset($request->discount_price) ?$request->discount_price:0,
            'description'  => isset($request->description) ?$request->description:null,
            'status'  => isset($request->status) ?$request->status:1,
            'featured'  => isset($request->featured) ?$request->featured:0,
            'thumbnail'  =>'images/'.$name,
            'options'  =>isset($request->extras) ? json_encode($request->extras) : null,
        ]);
        if($product){
            $product->categories()->attach($request->category_id,['created_at'=>now(), 'updated_at'=>now()]);
            return Redirect::to('admin/product')
                    ->with('success','Product has been added successfully.');
        }else{
            return back()->with('fail','Something going wrong.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
         $data['front_scripts'] = array('js/pages/crud/forms/widgets/select2.js'); //array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
         $categories = Category::where('id','!=',$product->id)->get();
         $data['product'] = $product;
         $data['categories'] = $categories;
         $ids = (isset($product->categories) && $product->categories->count() > 0)? Arr::pluck($product->categories, 'id'):null;
         $data['ids'] = $ids;
         $data['extras'] = (isset($product->options) && !is_null($product->options)) ? json_decode($product->options,true): array();
        return View::make('backend_pages.products.add',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {

        if($request->has('thumbnail')){
            Storage::disk('public')->delete($product->thumbnail);
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images', $name);
            $product->thumbnail = $path;
        }
        $product->title =$request->title;
        //$product->slug = $request->slug;
        $product->description = $request->description;
        $product->status        = $request->status;
        $product->featured      =     ($request->featured) ? $request->featured : 0;
        $product->price         = $request->price;
        $product->discount      = $request->discount ? $request->discount : 0;
        $product->discount_price = ($request->discount_price) ? $request->discount_price : 0;
        $product->options = isset($request->extras) ? json_encode($request->extras) : null;

        $product->categories()->detach();
        
        if($product->save()){
            $product->categories()->attach($request->category_id, ['created_at'=>now(), 'updated_at'=>now()]);
            return Redirect::to('admin/product')
                    ->with('success', "Product Successfully Updated!");
        }else{
            return back()->with('fail', "Error Updating Product");
        }
    }

    /**
     * Recover the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function recoverProduct($id)
    {
        $product = Product::with('categories')->onlyTrashed()->findOrFail($id);
        if($product->restore()){
            return Redirect::to('admin/product')
                    ->with('success','Product Successfully Restored!');
        }else{
             return back()->with('fail','Error Restoring Product');
        }
        
           
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->categories()->detach() && $product->forceDelete()){
          
                // 1. possibility
                Storage::disk('public')->delete($product->thumbnail);
             
         
            return Redirect::to('admin/product')
                    ->with('success','Product Successfully Deleted!');
        }else{
            return back()->with('fail','Error Deleting Product');
        }
    }
         /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function remove(Product $product)
    {
        if($product->delete()){
            return Redirect::to('admin/product')
                    ->with('success','Product Successfully Trashed!');
        }else{
            return back()->with('fail','Error Deleting Product');
        }
    }

}
