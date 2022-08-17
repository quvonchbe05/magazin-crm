<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'cat_id' => "required|max:255",
            'name' => "required|max:255",
            'amount' => "required|max:255",
            'original_price' => "required|max:255",
            'sale_price' => "required|max:255",
            'postedBy' => "required|max:255",
            'description' => "required"
        ]);
        $product = new Product();
        $product->cat_id = $request->cat_id;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->original_price = $request->original_price;
        $product->sale_price = $request->sale_price;
        $product->deadLine = $request->deadLine;
        $product->postedBy = $request->postedBy;
        $product->description = $request->description;
        $product->save();
        return "Added!";
    }


    public function updateProduct(Request $request,$id)
    {
        $request->validate([
            'cat_id' => "required|max:255",
            'name' => "required|max:255",
            'amount' => "required|max:255",
            'original_price' => "required|max:255",
            'sale_price' => "required|max:255",
            'postedBy' => "required|max:255",
            'description' => "required"
        ]);
        $product = Product::findOrFail($id);
        $product->cat_id = $request->cat_id;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->original_price = $request->original_price;
        $product->sale_price = $request->sale_price;
        $product->deadLine = $request->deadLine;
        $product->postedBy = $request->postedBy;
        $product->description = $request->description;
        $product->save();
        return "Updated!";
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return "Deleted";
    }

    public function searchProduct(Request $request)
    {
        $products = DB::table('products')->where('name','like','%',$request->name,'%')->get();
        return response()->json([
            'products' => $products
        ]);
    }
}
