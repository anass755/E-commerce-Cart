<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
      $products = Product::with(['category', 'subcategory'])->get();
      return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        $categories=Category::where('parent_category', 0)->get();
       return view('products.create',compact('categories'));
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
      $validated=$request->validate([
        'categoryid'=>'required',
        'subcategory'=>'required',
        'name'             => 'required',
        'code'             => 'required',
        'shortdescription'=> 'required',
        'specification'    => 'required',
        'rate'             => 'required',
       
      ]);

         
            // image section //
            $path=public_path().'/app/products';

            if(!File::isDirectory($path));{
            File::makeDirectory($path,0777,true,true);
            }

            $image = $request->file('photo');

            if($request->photo){
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            Storage::disk('public2')->put($imageName, file_get_contents($image));

            $destinationPathThumbnail = public_path('/app/products');
            $img = Image::read($image->path());

            $a = $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);

            }else{
            $imageName='defaultproduct.png';
            }
        // end-image section //


      $result=Product::create([
        'category_id'=>$request->categoryid,
        'sub_category'=>$request->subcategory,
        'name'=>$request->name,
        'code'=>$request->code,
        'short_description'=>$request->shortdescription,
        'specification'=>$request->specification,
        'rate'=>$request->rate,
        'photo'=> $imageName 
      ]);
      if($result){
        return redirect()->route('product.index');
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
      
      $products=Product::findOrFail($id);
      
      $categories=Category::where('parent_category', 0)->get();
    
      $subcategories=Category::where('parent_category',$products->category_id)->get();
      
     return view('products.edit',compact('products','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validated=$request->validate([
        'name'             => 'required',
        'code'             => 'required',
        'shortdescription'=> 'required',
        'specification'    => 'required',
        'rate'             => 'required',
        'photo'            => 'required' // Max 2MB
      ]);


      $path=public_path().'/app/products';

      if(!File::isDirectory($path)){
        File::makeDirectory($path,0777,true,true);
      }
      
      $author = Product::find($id);
      $image = $request->file('photo');

      if(($request->hasFile('photo') && $request->file('photo')->isValid())){
        File::delete(public_path().'/app/products/'. $author->photo);

        $imageName = time().'.'.$image->getClientOriginalExtension();
        Storage::disk('public2')->put($imageName, file_get_contents($image));
      }
      else{
        $imageName = $author->image;
    }

        $result=Product::find($id)->update([
            'category_id'=>$request->categoryid,
            'sub_category'=>$request->subcategoryid,
            'name'=>$request->name,
            'code'=>$request->code,
            'short_description'=>$request->shortdescription,
            'specification'=>$request->specification,
            'rate'=>$request->rate,
            'photo'=> $imageName 
            
        ]);

      if($result){
        return redirect()->route('product.index');
      }  

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result=Product::find($id)->delete();

       if($result){
        return redirect()->route('product.index');
       }
    }
    





}
