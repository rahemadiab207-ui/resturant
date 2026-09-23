<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        // جلب بيانات القسم، وإذا لم يوجد يظهر 404
        $category = Category::findOrFail($id);

        // جلب الوجبات المرتبطة بهذا القسم
        $meals = Meal::where('category_id', $id)->get();

        // إرسال البيانات للـ View
        return view('meals.index', compact('category', 'meals'));
    }
}