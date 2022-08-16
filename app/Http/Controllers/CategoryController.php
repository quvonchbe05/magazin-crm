<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
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
        return "Added!";
    }

    public function updateCategory(Request $request,$id)
    {
        $request->validate([
            'cat_name' => "required|max:255|unique:categories"
        ]);
        $category = Category::findOrFail($id);
        $category->cat_name = $request->cat_name;
        $category->save();
        return "Updated!";
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return "Deleted!";
    }
}
