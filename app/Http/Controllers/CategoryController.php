<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $masterClasses = $category->masterClasses;

        return view('category', compact('category', 'masterClasses'));
    }
}