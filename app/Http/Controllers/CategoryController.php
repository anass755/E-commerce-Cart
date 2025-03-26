<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $categories=Category::all();
  
      return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $parentCategories = Category::where('parent_category', 0)->get();
    

       return view('category.create',compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validated=$request->validate([
        'name'=>'required',
        'parentcategory'=>'required',
        'status'=>'required'
      ]);

      $result=Category::create([
        'parent_category'=>$request->parentcategory,
        'name'=>$request->name,
        'status'=>$request->status
      ]);

      if($result){
        return redirect()->route('category.index');
      }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $categoryname=Category::findOrFail($id);
      return view('category.edit',compact('categoryname'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
      $validated=$request->validate([
       'name'=>'required',
       'status'=>'required'
      ]);

      $result=Category::find($id)->update([
        'name'=>$request->name,
        'status'=>$request->status
      ]);

       if($result){
        return redirect()->route('category.index');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
      $categoryCount=Category::where('parent_category', $id)->count();
      
      if($categoryCount !=0){
        return back()->with('error',"The paraent category you are trying to delete has subcategories");
      }
        else{
          $result=Category::find($id)->delete();
        } 
      if($result){
        return redirect()->route('category.index');
      }
    }
}
