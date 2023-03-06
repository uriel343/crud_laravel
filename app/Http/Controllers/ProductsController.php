<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $students = Product::all();

        if ($students->count() > 0) {
            $data = [
                'status' => 200,
                'students' => $students
            ];
            return response()->json($data, 200);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "There are not records to show"
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:200',
            'sku' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->messages()
            ], 422);
        } else {
            $product = Product::create([
                "name" => $request->name,
                "description" => $request->description,
                "sku" => $request->sku,
                "price" => $request->price
            ]);

            if ($product) {
                return response()->json([
                    "status" => 200,
                    "message" => "Product saved successfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => 500,
                    "message" => "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return response()->json([
                "status" => 200,
                "product" => $product
            ], 200);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Product not found"
            ], 404);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:200',
            'sku' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->messages()
            ], 422);
        } else {

            $product = Product::find($id);

            if ($product) {

                $product->update([
                    "name" => $request->name,
                    "description" => $request->description,
                    "sku" => $request->sku,
                    "price" => $request->price
                ]);

                return response()->json([
                    "status" => 200,
                    "message" => "Product udpated successfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => 500,
                    "message" => "Something went wrong"
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                "status" => 200,
                "message" => "Product deleted succesfully"
            ], 404);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Product not found"
            ], 404);
        }
    }
}
