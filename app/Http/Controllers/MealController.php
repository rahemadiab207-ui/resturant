<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with('category')->get();
        $categories = Category::all();
return view('meals.index', compact('meals', 'categories'));    }

    public function create()
{
    $categories = Category::all();
    $meals = Meal::with('category')->latest()->get();

    return view('admin.meals.create', compact('categories', 'meals'));
}

    public function store(Request $request)
{
    // التحقق من صحة المدخلات
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'discount_price'    => 'nullable|numeric|min:0|max:100', // أضيفي هذا السطر للتحقق من الخصم
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // رفع الصورة إذا تم اختيارها
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('meals', 'public');
    }

    // إنشاء الوجبة مع قيمة الخصم
    Meal::create([
        'name'        => $request->name,
        'description' => $request->description,
        'price'       => $request->price,
        'discount_price' => $request->discount, 
        'is_on_sale'  =>$request->filled('discount')? 1:0,
        'category_id' => $request->category_id,
        'image'       => $imagePath,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'تمت إضافة الوجبة بنجاح! ✨');
}

    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
        $categories = Category::all();
        return view('admin.meals.edit', compact('meal', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'discount_price'    => 'nullable|numeric|min:0|max:100',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            
        ]);

        $data = [
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'discount_price'=> $request->discount,
            'is_on_sale'  =>$request->filled('discount')? 1:0,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            if ($meal->image && Storage::disk('public')->exists($meal->image)) {
                Storage::disk('public')->delete($meal->image);
            }
            $data['image'] = $request->file('image')->store('meals', 'public');
        }

        $meal->update($data);

        return redirect()->route('admin.meals.create')->with('success', 'تم تحديث الوجبة بنجاح! ✨');
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);

        if ($meal->image && Storage::disk('public')->exists($meal->image)) {
            Storage::disk('public')->delete($meal->image);
        }

        $meal->delete();

        return redirect()->route('admin.meals.create')->with('success', 'تم حذف الوجبة بنجاح!');
    }
}