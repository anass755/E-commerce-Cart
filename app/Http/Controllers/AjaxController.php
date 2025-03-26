<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function categorySelect(Request $request, $id)
    {
        $categories=Category::where('parent_category', $id)->get();

        return response()->json([ $categories]);
    }
}
