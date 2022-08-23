<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('categories.index',[
            'categories' => $categories,
        ]);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'cat_name' => "required|max:255|unique:categories"
        ]);
        $category = new Category();
        $category->cat_name = $request->cat_name;
        $category->save();
        return redirect()->back()->with('success',"Kategoriya qo'shildi!");
    }

    public function updateCategory(Request $request,$id)
    {
        $request->validate([
            'cat_name' => "required|max:255"
        ]);
        $category = Category::findOrFail($id);
        $category->cat_name = $request->cat_name;
        $category->save();
        return redirect()->back()->with('success',"Kategoriya taxrirlandi!");
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success',"Kategoriya O'chirildi!");
    }
}
