<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::simplePaginate(3);
        $categories = Category::paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    public function trash(){
       $categories = Category::onlyTrashed()->paginate(3);
       return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
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
         'title' => 'required|min:5',
         'slug' => 'required|min:5|unique:categories'
        ]);
        $categories = Category::create($request->only('title', 'description', 'slug'));
        $categories->childrens()->attach($request->parent_id);
        return back()->with('message', 'Category added Successfully');
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
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.create', ['categories' => $categories, 'category' => $category]);
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
         $category->title = $request->title;
         $category->description = $request->description;
         $category->slug = $request->slug;
         //detach all parents categories
         $category->childrens()->detach();
         //attach selected parent category
         $category->childrens()->attach($request->parent_id);
         //update category save
         $saved = $category->save();

         return back()->with('message', 'Category Successfully Update');
    }

    public function recoverCat($id){
        //$category = Category::withTrashed()->findOrFail($id);
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore()){
          return back()->with('message', 'Category Successfully Restored');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->childrens()->detach() && $category->forceDelete()){
          return back()->with('message', 'Category Successfully Deleted');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
    }

    public function remove($id){
        $category = Category::findOrFail($id);
        if($category->delete()){
          return back()->with('message', 'Category Successfully Trashed');       
        }
        else{
            return back()->with('message', 'Error!!!');
        }
    }

    public function deleteTrashCat($id){
        $category = Category::where('id', $id)->forceDelete();
        if($category){
         return back()->with('message', 'Category Successfully Deleted');
        }
    }
}






