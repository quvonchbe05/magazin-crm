<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderByDesc('id')->paginate(10);
        $workers = Worker::orderByDesc('id')->get();
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'workers' => $workers
        ]);
    }

    public function addForm()
    {
        $categories = Category::all();
        $workers = Worker::orderByDesc('id')->get();
        return view('products.add', [
            'categories' => $categories,
            'workers' => $workers
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'cat_id' => "required|max:255",
            'name' => "required|max:255",
            'amount' => "required",
            'original_price' => "required",
            'sale_price' => "required",
            'postedBy' => "required",
            'description' => "required"
        ]);
        if($request->amount <= 0 || $request->original_price <= 0 || $request->sale_price <= 0){
            throw ValidationException::withMessages([
                'product_count' => ['Iltimos no\'l(0)dan kattaroq son kiriting!'],
            ]);
        }
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
        return redirect()->back()->with('success', "Maxsulot qo'shildi!");
    }

    public function updateForm($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $workers = Worker::orderByDesc('id')->get();
        return view('products.form', [
            'product' => $product,
            'workers' => $workers,
            'categories' => $categories
        ]);
    }

    public function updateProduct(Request $request, $id)
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
        if($request->amount <= 0 || $request->original_price <= 0 || $request->sale_price <= 0){
            throw ValidationException::withMessages([
                'product_count' => ['Iltimos no\'l(0)dan kattaroq son kiriting!'],
            ]);
        }
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
        return redirect()->back()->with('success', "Maxsulot taxrirlandi!");
    }

    public function show($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $workers = Worker::orderByDesc('id')->get();
        return view('products.show', [
            'product' => $product,
            'workers' => $workers,
            'categories' => $categories
        ]);
    }

    public function deletePage($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete', [
            'product' => $product
        ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', "Maxsulot o'chirildi");
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->name . '%')->leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name','products.*')->orderByDesc('id')->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function filterByCategory(Request $request)
    {
        $products = Product::where('cat_id', 'like', '%' . $request->cat_id . '%')->leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name','products.*')->orderByDesc('id')->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function sortDesc()
    {
        $products = Product::leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name','products.*')->orderBy('amount','desc')->get();
        return response()->json([
            'products' => $products
        ]);
    }

    
    public function sortAsc()
    {
        $products = Product::leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name','products.*')->orderBy('amount','asc')->get();
        return response()->json([
            'products' => $products
        ]);
    }
}
