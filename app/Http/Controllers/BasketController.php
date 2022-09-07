<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Category;
use App\Models\Product;
use App\Models\Saled;
use App\Models\SaledGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BasketController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(10);
        $categories = Category::orderByDesc('id')->get();
        $amount = Basket::where('worker_id',Auth::user()->id)->count();
        return view('basket.index', [
            'products' => $products,
            'categories' => $categories,
            'amount' => $amount
        ]);
    }

    public function setToBasket(Request $request, $id)
    {
        $request->validate([
            'product_count' => "required|numeric"
        ]);
        if ($request->product_count <= 0) {
            throw ValidationException::withMessages([
                'product_count' => ['Iltimos no\'l(0)dan kattaroq son kiriting!'],
            ]);
        }

        $product = Product::findOrFail($id);
        $basket = Basket::where('product_id', $id)->where('worker_id', Auth::user()->id)->get();
        if (count($basket) === 1) {
            $basket = Basket::where('product_id', $id)->where('worker_id', Auth::user()->id)->first();
            $basket->product_count = $request->product_count + $basket->product_count;
            $basket->summa = $basket->product_price * $request->product_count;
            $basket->save();
        } else {
            $basketNew = new Basket();
            $basketNew->product_id = $product->id;
            $basketNew->product_count = $request->product_count;
            $basketNew->product_price = $product->sale_price;
            $basketNew->summa = $product->sale_price * $request->product_count;
            $basketNew->worker_id = Auth::user()->id;
            $basketNew->save();
        }
        return redirect()->back()->with('success', "Maxsulot savatga qo'shildi!");
    }

    public function basket()
    {
        $products = Basket::where('worker_id', Auth::user()->id)->orderByDesc('id')->get();
        $summa = Basket::where('worker_id', Auth::user()->id)->sum('summa');
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

        if ($request->product_count <= 0) {
            throw ValidationException::withMessages([
                'product_count' => ['Iltimos no\'l(0)dan kattaroq son kiriting!'],
            ]);
        }

        $basket = Basket::findOrFail($id);
        $basket->product_price = $request->product_price;
        $basket->product_count = $request->product_count;
        $basket->summa = $request->product_price * $request->product_count;
        $basket->save();
        return redirect()->back()->with('success', "Yangilandi");
    }

    public function deleteOnTheBasket($id)
    {
        $basket = Basket::findOrFail($id);
        $basket->delete();
        return redirect()->back()->with('success', "O'chirildi!");
    }


    public function saveToSaled()
    {
        $basket = Basket::where('worker_id', Auth::user()->id)->get();
        foreach ($basket as $key => $value) {
            $products = Product::whereId($value->product_id)->first();
            $group = SaledGroup::where('product_id', $value->product_id)->where('worker_id', Auth::user()->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->get();
            if (count($group) === 1) {
                $group = SaledGroup::where('product_id', $value->product_id)->where('worker_id', Auth::user()->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->first();
                $group->product_count = $group->product_count + $value->product_count;
                $group->save();
            } else {
                $newGroup = new SaledGroup();
                $newGroup->product_id = $value->product_id;
                $newGroup->worker_id = $value->worker_id;
                $newGroup->product_count = $value->product_count;
                $newGroup->save();
            }
            $new = new Saled();
            if ($value->product_count > $products->amount) {
                throw ValidationException::withMessages([
                    'product_count' => ['Bazada ' . $products->name . ' yetarli emas!'],
                ]);
            }
            if ($value->product_count <= 0) {
                throw ValidationException::withMessages([
                    'product_count' => ['Iltimos ' . $products->name . ' uchun no\'l(0)dan kattaroq son kiriting!'],
                ]);
            }
            $products->amount = $products->amount - $value->product_count;
            $new->product_id = $value->product_id;
            $new->original_price = $products->sale_price;
            $new->product_price = $value->product_price;
            $new->product_count = $value->product_count;
            $new->summa = $value->product_price * $value->product_count;
            $new->worker_id = Auth::user()->id;
            $new->save();
            $products->save();
        }
        Basket::where('worker_id', Auth::user()->id)->delete();
        return redirect()->route('basket.index')->with('success', "Sotildi!");
    }

    public function removeBasket()
    {
        Basket::where('worker_id', Auth::user()->id)->delete();
        return redirect()->back()->with('success', "Tozalandi!");
    }

    public function sale($id)
    {
        $product = Product::findOrFail($id);
        return view('basket.sale', [
            'product' => $product
        ]);
    }

    public function saleOne(Request $request, $id)
    {
        $request->validate([
            'sale_price' => "required|numeric",
            'product_count' => "required|numeric",
        ]);
        $product = Product::findOrFail($id);
        $group = SaledGroup::where('product_id', $product->id)->where('worker_id', Auth::user()->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->get();
        if (count($group) === 1) {
            $group = SaledGroup::where('product_id', $product->id)->where('worker_id', Auth::user()->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->first();
            $group->product_count = $group->product_count + $request->product_count;
            $group->save();
        } else {
            $newGroup = new SaledGroup();
            $newGroup->product_id = $product->id;
            $newGroup->worker_id = Auth::user()->id;
            $newGroup->product_count = $request->product_count;
            $newGroup->save();
        }
        $new = new Saled();
        if ($request->product_count > $product->amount) {
            throw ValidationException::withMessages([
                'product_count' => ['Bazada maxsulot yetarli emas!'],
            ]);
        }
        if ($request->product_count <= 0) {
            throw ValidationException::withMessages([
                'product_count' => ['Iltimos uchun no\'l(0)dan kattaroq son kiriting!'],
            ]);
        }
        $new->product_id = $product->id;
        $new->original_price = $product->sale_price;
        $new->product_price = $request->sale_price;
        $new->product_count = $request->product_count;
        $new->worker_id = Auth::user()->id;
        $new->summa = $request->sale_price * $request->product_count;
        $product->amount = $product->amount - $request->product_count;
        $product->save();
        $new->save();
        return redirect()->route('basket.index')->with('success', "Sotildi!");
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->name . '%')->leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name', 'products.*')->orderByDesc('id')->paginate(10);
        $categories = Category::orderByDesc('id')->get();
        return view('basket.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function filter(Request $request)
    {
        $products = Product::where('cat_id', 'like', '%' . $request->category . '%')->leftJoin('categories', 'products.cat_id', '=', 'categories.id')->select('categories.cat_name', 'products.*')->orderByDesc('id')->paginate(10);
        $categories = Category::orderByDesc('id')->get();
        return view('basket.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
