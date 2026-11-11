<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    // this method will retunr all categories
    public function index(){
       $categories = Category::orderBy('created_at', 'DESC')->get();
       return response()->json([
        'status' => required,
        'data' => $categories

       ]);
    }

    // this method will return the store category in db
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'name' => 'required',

       ]);
       if($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->errors()
        ], 400);
    }
       $category = new Category();
         $category->name = $request->name;
            $category->status = $request->status;
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'Category created successfully',
                'data' => $category
            ], 200);
    }
    // this method will return the  single category
    public function show($id)
    {
       $category = Category::find($id);
       if  ($category == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
                'data' => []
            ], 404);
       }
       return response()->json([
        'status' => 200,
        'data' => $category

       ]);
    }

    // this method will  the update single category
    public function update($id, Request $request)
    {
        $category = Category::find($id);
       if  ($category == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
                'data' => []
            ], 404);
       }
        $validator = Validator::make($request->all(), [
        'name' => 'required',

       ]);
       if($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->errors()
        ], 400);
    }

         $category->name = $request->name;
            $category->status = $request->status;
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
    }

    // this method will destroy the single category
    public function destroy($id)
    {
        $category = Category::find($id);

       if  ($category == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
                'data' => []
            ], 404);
       }

       $category->delete();
        return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully',
            ], 200);
    }

}


