<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Workers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderByDesc('id')->paginate(10);
        $workers = Workers::orderByDesc('id')->get();
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'workers' => $workers
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
        return redirect()->back()->with('success',"Maxsulot qo'shildi!");
    }

    public function updateForm($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $workers = Workers::orderByDesc('id')->get();
        return view('products.form',[
            'product' => $product,
            'workers' => $workers,
            'categories' => $categories
        ]);
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
        return redirect()->back()->with('success',"Maxsulot taxrirlandi!");
    }

    public function show($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $workers = Workers::orderByDesc('id')->get();
        return view('products.show',[
            'product' => $product,
            'workers' => $workers,
            'categories' => $categories
        ]);
    }

    public function deletePage($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete',[
            'product' => $product
        ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success',"Maxsulot o'chirildi");
    }
}
