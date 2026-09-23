<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * عرض قائمة المنيو الكاملة (جميع الأقسام والوجبات التابعة لها)
     */
    public function index(Request $request)
    {
        // إمكانية البحث عن وجبة معينة من المنيو
        $search = $request->input('search');

        if ($search) {
            // جلب الوجبات التي تطابق بحث المستخدم
            $meals = Meal::where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->get();

            return view('menu.index', compact('meals', 'search'));
        }

        // جلب جميع الأقسام مع الوجبات التابعة لكل قسم (Eager Loading لمنع بطء قاعدة البيانات)
        $categories = Category::with('meals')->get();

        return view('menu.index', compact('categories'));
    }

    /**
     * عرض وجبات قسم معين فقط عند الضغط عليه
     */
   public function category($slug)
    {
        // 1. جلب القسم بواسطة الـ slug
        $category = Category::where('slug', $slug)-> firstOrFail();

        $categories=category::all();
        // 2. جلب الوجبات
        $meals = Meal::where('category_id', $category->id)->get();

        // 3. إرجاع الـ view
        return view('menu.index', compact('category','categories'));
    }
    /**
     * عرض تفاصيل وجبة واحدة
     */
    public function show($id){
     
      $category = Category::where('slug', $slug)->whith('meals')->firstOrFail();
        return view('meals.indax', compact('category'));
    }
}