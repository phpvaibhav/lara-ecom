<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use View,Redirect;
use Illuminate\Support\Arr;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['front_scripts'] = array(); //array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
        $categories         = Category::paginate(3);
        $data['categories'] = $categories;
        return View::make('backend_pages.category.index',$data);
    }
   
/**
     * Display a trashed listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
         $data['front_scripts'] = array(); //array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
           $categories = Category::onlyTrashed()->paginate(3);
         $data['categories'] = $categories;
       return View::make('backend_pages.category.index',$data);
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
       return View::make('backend_pages.category.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|min:5|max:25',
        'slug' => 'required|unique:categories',
        ]);
        $categories = Category::create($request->only('title','description','slug'));
        $categories->childens()->attach($request->parent_id);
        if($categories){
            return Redirect::to('admin/category')
       ->with('success','Category has been added successfully.');
        }else{
            return back()->with('fail','Something going wrong.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
         $data['front_scripts'] = array('js/pages/crud/forms/widgets/select2.js'); //array('js/pages/crud/datatables/data-sources/ajax-server-side.js');
         $categories = Category::where('id','!=',$category->id)->get();
         $data['category'] = $category;
         $data['categories'] = $categories;
         $ids = (isset($category->childens) && $category->childens->count() > 0)? Arr::pluck($category->childens, 'id'):null;
         $data['ids'] = $ids;
       return View::make('backend_pages.category.add',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
        'title' => 'required|min:5|max:25',
        'slug' => 'required|unique:categories',
        ]);
       $category->title = $request->title;
       $category->slug = $request->slug;
       $category->description = $request->description;
       //detach children
       $category->childens()->detach();
       $category->childens()->attach($request->parent_id);
       $saved = $category->save();
       if($saved){
            return Redirect::to('admin/category')
       ->with('success','Category has been updated successfully.');
        }else{
            return back()->with('fail','Something going wrong.');
        }
    }
    public function recoverCat($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore()){
            return back()->with('success','Category restored successfully.');
        }else{
           return back()->with('fail','Something going wrong.'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->childrens()->detach() && $category->forceDelete()){
            return Redirect::to('admin/category')
       ->with('success','Category has been Deleted successfully.');
        }else{
            return back()->with('fail','Something going wrong.');
        }
    } 
    public function remove(Category $category)
    {
        if($category->delete()){
            return Redirect::to('admin/category')
       ->with('success','Category has been trash successfully.');
        }else{
            return back()->with('fail','Something going wrong.');
        }
    }
}
