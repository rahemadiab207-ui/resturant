<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function show($slug)
{
    // البحث باستخدام الـ slug أو الاسم بدلاً من الـ id
    $category = Category::where('slug', $slug)->firstOrFail(); 
    $meals = Meal::where('category_id', $category->id)->get();
$categories = Category::all();
    return view('meals.index', compact('category', 'meals'));
}
}
