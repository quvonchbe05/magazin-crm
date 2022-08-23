<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Category;
use App\Models\Product;
use App\Models\Saled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(15);
        $categories = Category::orderByDesc('id')->get();
        return view('basket.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function setToBasket(Request $request, $id)
    {
        $request->validate([
            'product_count' => "required|numeric"
        ]);
        $product = Product::findOrFail($id);
        $basket = new Basket();
        $basket->product_id = $product->id;
        $basket->product_count = $request->product_count;
        $basket->product_price = $product->sale_price;
        $basket->summa = $product->sale_price * $request->product_count;
        $basket->worker_id = Auth::user()->id;
        $basket->save();
        return redirect()->back()->with('success', "Maxsulot savatga qo'shildi!");
    }

    public function basket()
    {
        $products = Basket::where('worker_id',Auth::user()->id)->orderByDesc('id')->get();
        $summa = Basket::where('worker_id',Auth::user()->id)->sum('summa');
        return view('basket.basket', [
            'products' => $products,
            'summa' => $summa
        ]);
    }

    public function basketRefresh(Request $request, $id)
    {
        $request->validate([
            'product_price' => "required|numeric",
            'product_count' => "required|numeric",
        ]);

        $basket = Basket::findOrFail($id);
        $basket->product_price = $request->product_price;
        $basket->product_count = $request->product_count;
        $basket->summa = $request->product_price * $request->product_count;
        $basket->save();
        return redirect()->back()->with('success', "Yangilandi");
    }


    public function saveToSaled()
    {
        $basket = Basket::where('worker_id',Auth::user()->id)->get();
        foreach ($basket as $key => $value) {
            $products = Product::whereId($value->product_id)->first();
            $new = new Saled();
            $products->amount = $products->amount - $value->product_count;
            $new->product_id = $value->product_id;
            $new->original_price = $products->sale_price;
            $new->product_price = $value->product_price;
            $new->product_count = $value->product_count;
            $new->summa = $value->product_price*$value->product_count;
            $new->worker_id = Auth::user()->id;
            $new->save();
            $products->save();
        }
        Basket::where('worker_id',Auth::user()->id)->delete();
        return redirect()->route('basket.index')->with('success',"Sotildi!");
    }

    public function removeBasket()
    {
        Basket::where('worker_id',Auth::user()->id)->delete();
        return redirect()->back()->with('success',"Tozalandi!");
    }

    public function sale($id)
    {
        $product = Product::findOrFail($id);
        return view('basket.sale',[
            'product' => $product
        ]);
    }

    public function saleOne(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $new = new Saled();
        $new->product_id = $product->id;
        $new->original_price = $product->sale_price;
        $new->product_price = $request->sale_price;
        $new->product_count = $request->product_count;
        $new->worker_id = Auth::user()->id;
        $new->summa = $request->sale_price*$request->product_count;
        $product->amount = $product->amount - $request->product_count;
        $product->save();
        $new->save();
        return redirect()->route('basket.index')->with('success',"Sotildi!");
    }
}
