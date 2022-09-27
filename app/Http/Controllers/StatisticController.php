<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Saled;
use App\Models\SaledGroup;
use App\Models\Worker;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');
        $month = date('Y-m');
        $saleds = SaledGroup::where('updated_at', 'like', '%' . $date . '%')->orderByDesc('updated_at')->paginate(15);
        $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->sum('summa');
        $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->sum('summa');
        $workers = Worker::orderByDesc('id')->get();
        return view('statistic.index', [
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
            'workers' => $workers
        ]);
    }

    public function filterByDate(Request $request)
    {
        if ($request->date) {
            $date = date($request->date);
            if ($request->date) {
                $date = date($request->date);
            } else {
                $date = date('Y-m-d');
            }
            $month = date('Y-m');
            $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
            $saleds = SaledGroup::where('saled_groups.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saled_groups.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saled_groups.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saled_groups.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saled_groups.*')
                ->orderByDesc('saled_groups.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        } elseif ($request->month) {
            $date = date($request->month);
            if ($request->month) {
                $date = date($request->month);
            } else {
                $date = date('Y-m-d');
            }
            $month = date($request->month);
            $sumday = 0;
            $saleds = SaledGroup::where('saled_groups.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saled_groups.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saled_groups.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saled_groups.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saled_groups.*')
                ->orderByDesc('saled_groups.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        } else {
            $date = date($request->date);
            if ($request->date) {
                $date = date($request->date);
            } else {
                $date = date('Y-m-d');
            }
            $month = date(substr($request->month, 0, 8));
            $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
            $saleds = SaledGroup::where('saled_groups.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saled_groups.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saled_groups.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saled_groups.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saled_groups.*')
                ->orderByDesc('saled_groups.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        }
        return response()->json([
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
        ]);
    }

    public function filterByDateMore(Request $request)
    {
        if ($request->date) {
            $date = date($request->date);
            if ($request->date) {
                $date = date($request->date);
            } else {
                $date = date('Y-m-d');
            }
            $month = date('Y-m');
            $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
            $saleds = Saled::where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saleds.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saleds.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saleds.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saleds.*')
                ->orderByDesc('saleds.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        } elseif ($request->month) {
            $date = date($request->month);
            if ($request->month) {
                $date = date($request->month);
            } else {
                $date = date('Y-m-d');
            }
            $month = date($request->month);
            $sumday = 0;
            $saleds = Saled::where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saleds.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saleds.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saleds.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saleds.*')
                ->orderByDesc('saleds.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        } else {
            $date = date($request->date);
            if ($request->date) {
                $date = date($request->date);
            } else {
                $date = date('Y-m-d');
            }
            $month = date(substr($request->month, 0, 8));
            $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
            $saleds = Saled::where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')
                ->where('saleds.created_at', 'like', '%' . $date . '%')
                ->leftJoin('products', 'saleds.product_id', '=', 'products.id')
                ->leftJoin('workers', 'saleds.worker_id', '=', 'workers.id')
                ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
                ->select('products.name', 'workers.fish', 'categories.cat_name', 'saleds.*')
                ->orderByDesc('saleds.updated_at')->get();
            $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        }
        return response()->json([
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
        ]);
    }

    public function filterByMonth(Request $request)
    {
        // $date = date($request->date);
        $month = date($request->month);
        $sumday = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        $saleds = SaledGroup::where('saled_groups.worker_id', 'like', '%' . $request->worker_id . '%')
            ->where('saled_groups.created_at', 'like', '%' . $month . '%')
            ->leftJoin('products', 'saled_groups.product_id', '=', 'products.id')
            ->leftJoin('workers', 'saled_groups.worker_id', '=', 'workers.id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.name', 'workers.fish', 'categories.cat_name', 'saled_groups.*')
            ->orderByDesc('saled_groups.id')->get();
        $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        return response()->json([
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
        ]);
    }


    public function filterByMonthMore(Request $request)
    {
        // $date = date($request->date);
        $month = date($request->month);
        $sumday = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        $saleds = Saled::where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')
            ->where('saleds.created_at', 'like', '%' . $month . '%')
            ->leftJoin('products', 'saleds.product_id', '=', 'products.id')
            ->leftJoin('workers', 'saleds.worker_id', '=', 'workers.id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.name', 'workers.fish', 'categories.cat_name', 'saleds.*')
            ->orderByDesc('saleds.id')->get();
        $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->where('saleds.worker_id', 'like', '%' . $request->worker_id . '%')->sum('summa');
        return response()->json([
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
        ]);
    }


    public function qayta($id)
    {
        $basket = Saled::findOrFail($id);
        $saledGroup = SaledGroup::where('product_id',$basket->product_id)->where('updated_at','like','%'.substr(($basket->updated_at),0,10).'%')->where('worker_id',$basket->worker_id)->first();
        $product = Product::findOrFail($basket->product_id);
        $product->amount = $product->amount + $basket->product_count;
        $saledGroup->product_count = $saledGroup->product_count - $basket->product_count;
        $saledGroup->updated_at  = $saledGroup->updated_at;
        $saledGroup->save();
        $product->save();
        $basket->delete();
        return redirect()->back()->with('success', "Maxsulot qaytarib berildi!");
        // dd(substr(($basket->created_at),0,10));
    }

    public function deletePage($id)
    {
        $saled = Saled::findOrFail($id);
        return view('statistic.delete', [
            'saled' => $saled
        ]);
    }

    public function delete($id)
    {
        $basket = Saled::findOrFail($id);
        $saledGroup = SaledGroup::where('product_id',$basket->product_id)->where('updated_at','like','%'.substr(($basket->updated_at),0,10).'%')->where('worker_id',$basket->worker_id)->first();
        $saledGroup->product_count = $saledGroup->product_count - $basket->product_count;
        $saledGroup->updated_at  = $saledGroup->updated_at;
        $saledGroup->save();
        $basket->delete();
        return redirect()->route('statistic.index')->with('success', "O'chirildi!");
    }

    public function views()
    {
        $sumday = Saled::where('product_id', $_GET['product'])->where('worker_id', $_GET['user'])->where('created_at', 'like', '%' . $_GET['date'] . '%')->sum('summa');
        $saleds = Saled::where('product_id', $_GET['product'])->where('worker_id', $_GET['user'])->where('created_at', 'like', '%' . $_GET['date'] . '%')->orderByDesc('id')->paginate(10);
        return view('statistic.view', [
            'saleds' => $saleds,
            'sumday' => $sumday
        ]);
    }

    public function more()
    {
        $date = date('Y-m-d');
        $month = date('Y-m');
        $saleds = Saled::where('created_at', 'like', '%' . $date . '%')->orderByDesc('id')->paginate(10);
        $sumday = Saled::where('created_at', 'like', '%' . $date . '%')->sum('summa');
        $summonth = Saled::where('created_at', 'like', '%' . $month . '%')->sum('summa');
        $workers = Worker::orderByDesc('id')->get();
        return view('statistic.more', [
            'saleds' => $saleds,
            'sumday' => $sumday,
            'summonth' => $summonth,
            'workers' => $workers
        ]);
    }
}
