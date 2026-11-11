<?php

namespace App\Http\Controllers\admin;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
class BrandController extends Controller
{
     public function index(){
       $brands = Brand::orderBy('created_at', 'DESC')->get();
       return response()->json([
        'status' => 200,
        'data' => $brands

       ]);
    }

    // this method will return the store brand in db
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
       $brand = new Brand();
         $brand->name = $request->name;
            $brand->status = $request->status;
            $brand->save();
            return response()->json([
                'status' => 200,
                'message' => 'Brand created successfully',
                'data' => $brand
            ], 200);
    }
    // this method will return the  single Brand
    public function show($id)
    {
       $brand = Brand::find($id);
       if  ($brand == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Brand not found',
                'data' => []
            ], 404);
       }
       return response()->json([
        'status' => 200,
        'data' => $brand

       ]);
    }

    // this method will  the update single Brand
    public function update($id, Request $request)
    {
        $brand = Brand::find($id);
       if  ($brand == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Brand not found',
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
      
         $brand->name = $request->name;
            $brand->status = $request->status;
            $brand->save();
            return response()->json([
                'status' => 200,
                'message' => 'Brand updated successfully',
                'data' => $brand
            ], 200);
    }

    // this method will destroy the single Brand
    public function destroy($id)
    {
        $brand = Brand::find($id);

       if  ($brand == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Brand not found',
                'data' => []
            ], 404);
       }
         
       $brand->delete();
        return response()->json([
                'status' => 200,
                'message' => 'Brand deleted successfully',              
            ], 200);
    }
}
