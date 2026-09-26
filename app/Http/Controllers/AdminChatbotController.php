<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function respond(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:2000',
            ]);

            $message = trim($request->input('message'));

            if ($message === '') {
                return $this->successResponse(
                    'اكتبي سؤالك الأول 😊'
                );
            }

            $text = $this->normalizeText($message);

            /*
            |--------------------------------------------------------------------------
            | Help
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'مساعده',
                'مساعدة',
                'help',
                'ماذا تستطيع',
                'تقدر تعمل ايه',
                'اسال ايه',
                'اسأل ايه',
            ])) {
                return $this->successResponse(
                    $this->helpResponse()
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Customers
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'عدد العملاء',
                'كام عميل',
                'عدد العميل',
                'العملاء كام',
                'العملاء عندي',
                'كم عميل',
            ])) {
                $totalCustomers = User::where(
                    'role',
                    'user'
                )->count();

                return $this->successResponse(
                    "👥 عدد العملاء المسجلين: {$totalCustomers} عميل."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Customer Information
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'بيانات العميل',
                'بيانات عميل',
                'العميل اسمه',
                'عميل اسمه',
            ])) {
                $customer = $this->findCustomer($message);

                if ($customer) {
                    $ordersCount = Order::where(
                        'user_id',
                        $customer->id
                    )->count();

                    return $this->successResponse(
                        "👤 بيانات العميل:\n\n" .
                        "الاسم: {$customer->name}\n" .
                        "الإيميل: {$customer->email}\n" .
                        "الهاتف: {$customer->phone1}\n" .
                        "العنوان: {$customer->address}\n" .
                        "عدد الطلبات: {$ordersCount}"
                    );
                }

                return $this->successResponse(
                    "ملقتش عميل بالاسم ده.\n\n" .
                    "جربي مثلاً:\n" .
                    "بيانات العميل أحمد"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Total Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'عدد الاوردرات',
                'عدد الأوردرات',
                'عدد الطلبات',
                'كام اوردر',
                'كام أوردر',
                'كام طلب',
                'الاوردرات كام',
                'الأوردرات كام',
                'الطلبات كام',
            ])) {
                $totalOrders = Order::count();

                return $this->successResponse(
                    "📦 إجمالي عدد الطلبات: {$totalOrders} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Pending Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الطلبات المعلقه',
                'الطلبات المعلقة',
                'كام طلب معلق',
                'كام اوردر معلق',
                'كام أوردر معلق',
                'الاوردرات المعلقه',
                'الأوردرات المعلقة',
                'pending',
            ])) {
                $count = Order::where(
                    'status',
                    'pending'
                )->count();

                return $this->successResponse(
                    "⏳ عدد الطلبات المعلقة: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Confirmed Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الطلبات المؤكده',
                'الطلبات المؤكدة',
                'كام طلب مؤكد',
                'كام اوردر مؤكد',
                'confirmed',
            ])) {
                $count = Order::where(
                    'status',
                    'confirmed'
                )->count();

                return $this->successResponse(
                    "✅ عدد الطلبات المؤكدة: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Preparing Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'طلبات قيد التحضير',
                'الطلبات قيد التحضير',
                'طلبات بتحضر',
                'كام طلب بيتحضر',
                'preparing',
            ])) {
                $count = Order::where(
                    'status',
                    'preparing'
                )->count();

                return $this->successResponse(
                    "👨‍🍳 عدد الطلبات قيد التحضير: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Ready Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الطلبات الجاهزه',
                'الطلبات الجاهزة',
                'كام طلب جاهز',
                'كام اوردر جاهز',
                'ready',
            ])) {
                $count = Order::where(
                    'status',
                    'ready'
                )->count();

                return $this->successResponse(
                    "📦 عدد الطلبات الجاهزة: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Out For Delivery
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'طلبات خرجت',
                'خرجت للتوصيل',
                'طلبات في الطريق',
                'طلبات للتوصيل',
                'out for delivery',
            ])) {
                $count = Order::where(
                    'status',
                    'out_for_delivery'
                )->count();

                return $this->successResponse(
                    "🚚 عدد الطلبات الخارجة للتوصيل: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Delivered Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الطلبات المكتمله',
                'الطلبات المكتملة',
                'الطلبات المسلمه',
                'الطلبات المسلمة',
                'كام طلب مكتمل',
                'كام اوردر مكتمل',
                'كام طلب اتسلم',
                'delivered',
            ])) {
                $count = Order::where(
                    'status',
                    'delivered'
                )->count();

                return $this->successResponse(
                    "🎉 عدد الطلبات المكتملة / المسلمة: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Cancelled Orders
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الطلبات الملغيه',
                'الطلبات الملغية',
                'كام طلب ملغي',
                'كام اوردر ملغي',
                'cancelled',
            ])) {
                $count = Order::where(
                    'status',
                    'cancelled'
                )->count();

                return $this->successResponse(
                    "❌ عدد الطلبات الملغاة: {$count} طلب."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Total Sales
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'اجمالي المبيعات',
                'إجمالي المبيعات',
                'المبيعات الكليه',
                'المبيعات الكلية',
                'كل المبيعات',
                'مجموع المبيعات',
                'المبيعات كام',
                'total sales',
            ])) {
                $sales = Order::where(
                    'status',
                    'delivered'
                )->sum('total');

                $sales = number_format(
                    (float) $sales,
                    2
                );

                return $this->successResponse(
                    "💰 إجمالي المبيعات من الطلبات المكتملة: {$sales} جنيه."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Monthly Sales
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'مبيعات الشهر',
                'مبيعات شهر',
                'مبيعات الشهر كام',
                'دخل الشهر',
                'sales this month',
            ])) {
                $sales = Order::where(
                    'status',
                    'delivered'
                )
                    ->whereMonth(
                        'created_at',
                        now()->month
                    )
                    ->whereYear(
                        'created_at',
                        now()->year
                    )
                    ->sum('total');

                $ordersCount = Order::where(
                    'status',
                    'delivered'
                )
                    ->whereMonth(
                        'created_at',
                        now()->month
                    )
                    ->whereYear(
                        'created_at',
                        now()->year
                    )
                    ->count();

                $sales = number_format(
                    (float) $sales,
                    2
                );

                return $this->successResponse(
                    "📅 مبيعات الشهر الحالي:\n\n" .
                    "💰 المبيعات: {$sales} جنيه\n" .
                    "📦 الطلبات المكتملة: {$ordersCount} طلب"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Yearly Sales
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'مبيعات السنه',
                'مبيعات السنة',
                'مبيعات العام',
                'مبيعات السنه كام',
                'مبيعات السنة كام',
                'sales this year',
            ])) {
                $sales = Order::where(
                    'status',
                    'delivered'
                )
                    ->whereYear(
                        'created_at',
                        now()->year
                    )
                    ->sum('total');

                $sales = number_format(
                    (float) $sales,
                    2
                );

                return $this->successResponse(
                    "📊 مبيعات سنة " .
                    now()->year .
                    ": {$sales} جنيه."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Best Selling Meals
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الاكثر مبيعا',
                'الأكثر مبيعاً',
                'اكثر الاكل مبيعا',
                'أكثر الاكل مبيعاً',
                'الاكل الاكثر مبيعا',
                'اكثر الوجبات مبيعا',
                'أكثر الوجبات مبيعاً',
                'الوجبات الاكثر مبيعا',
                'top meals',
                'best selling',
            ])) {
                $topMeals = OrderItem::select(
                    'meal_id',
                    DB::raw(
                        'SUM(quantity) as total_quantity'
                    )
                )
                    ->whereNotNull('meal_id')
                    ->groupBy('meal_id')
                    ->orderByDesc('total_quantity')
                    ->limit(10)
                    ->with('meal')
                    ->get();

                if ($topMeals->isEmpty()) {
                    return $this->successResponse(
                        'مفيش بيانات مبيعات للوجبات لسه.'
                    );
                }

                $response = "🔥 أكثر الوجبات مبيعاً:\n\n";

                $number = 1;

                foreach ($topMeals as $item) {
                    if (!$item->meal) {
                        continue;
                    }

                    $response .=
                        $number .
                        ". " .
                        $item->meal->name .
                        " — " .
                        $item->total_quantity .
                        " قطعة\n";

                    $number++;
                }

                return $this->successResponse(
                    trim($response)
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Meals Count
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'عدد الوجبات',
                'كام وجبه',
                'كام وجبة',
                'اجمالي الوجبات',
                'إجمالي الوجبات',
                'عدد الاكل',
                'عدد الأكل',
            ])) {
                $totalMeals = Meal::count();

                $availableMeals = Meal::where(
                    'is_available',
                    true
                )->count();

                $unavailableMeals = Meal::where(
                    'is_available',
                    false
                )->count();

                return $this->successResponse(
                    "🍔 إحصائيات الوجبات:\n\n" .
                    "إجمالي الوجبات: {$totalMeals}\n" .
                    "المتاحة حالياً: {$availableMeals}\n" .
                    "غير المتاحة: {$unavailableMeals}"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Available Meals
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الوجبات المتاحه',
                'الوجبات المتاحة',
                'هات الوجبات',
                'اعرض الوجبات',
                'عرض الوجبات',
                'كل الوجبات',
                'الاكل المتاح',
                'الأكل المتاح',
                'available meals',
                'meals',
            ])) {
                $meals = Meal::with('category')
                    ->where(
                        'is_available',
                        true
                    )
                    ->orderByDesc('rating')
                    ->limit(20)
                    ->get();

                return $this->successResponse(
                    $this->formatMealsResponse(
                        $meals,
                        '🍔 الوجبات المتاحة حالياً'
                    )
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Discounted Meals
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'الوجبات المخفضه',
                'الوجبات المخفضة',
                'وجبات عليها خصم',
                'وجبات عليها تخفيض',
                'الخصومات',
                'وجبات بخصم',
                'discount',
            ])) {
                $meals = Meal::with('category')
                    ->where(
                        'is_available',
                        true
                    )
                    ->where(
                        'is_on_sale',
                        true
                    )
                    ->whereNotNull(
                        'discount_price'
                    )
                    ->whereColumn(
                        'discount_price',
                        '<',
                        'price'
                    )
                    ->orderBy(
                        'discount_price'
                    )
                    ->get();

                if ($meals->isEmpty()) {
                    return $this->successResponse(
                        'مفيش وجبات عليها خصومات حالياً.'
                    );
                }

                return $this->successResponse(
                    $this->formatMealsResponse(
                        $meals,
                        '🔥 الوجبات عليها خصم'
                    )
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Cheapest Meal
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'ارخص وجبه',
                'أرخص وجبة',
                'ارخص اكل',
                'أرخص أكل',
                'اقل سعر',
                'أقل سعر',
            ])) {
                $meals = Meal::where(
                    'is_available',
                    true
                )->get();

                if ($meals->isEmpty()) {
                    return $this->successResponse(
                        'مفيش وجبات متاحة حالياً.'
                    );
                }

                $meal = $meals->sortBy(
                    fn ($meal) => (float) $meal->active_price
                )->first();

                $price = number_format(
                    (float) $meal->active_price,
                    2
                );

                return $this->successResponse(
                    "💰 أرخص وجبة هي: {$meal->name}\n" .
                    "السعر: {$price} جنيه"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Most Expensive Meal
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'اغلى وجبه',
                'أغلى وجبة',
                'اغلى اكل',
                'أغلى أكل',
                'اعلى سعر',
                'أعلى سعر',
            ])) {
                $meals = Meal::where(
                    'is_available',
                    true
                )->get();

                if ($meals->isEmpty()) {
                    return $this->successResponse(
                        'مفيش وجبات متاحة حالياً.'
                    );
                }

                $meal = $meals->sortByDesc(
                    fn ($meal) => (float) $meal->active_price
                )->first();

                $price = number_format(
                    (float) $meal->active_price,
                    2
                );

                return $this->successResponse(
                    "💰 أغلى وجبة هي: {$meal->name}\n" .
                    "السعر: {$price} جنيه"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Categories Count
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'عدد التصنيفات',
                'كام تصنيف',
                'التصنيفات كام',
                'عدد الكاتيجوري',
                'عدد categories',
            ])) {
                $count = Category::count();

                return $this->successResponse(
                    "🏷️ عدد التصنيفات: {$count} تصنيف."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Categories List
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'اعرض التصنيفات',
                'عرض التصنيفات',
                'هات التصنيفات',
                'كل التصنيفات',
                'categories',
            ])) {
                $categories = Category::withCount(
                    'meals'
                )
                    ->orderBy('name')
                    ->get();

                if ($categories->isEmpty()) {
                    return $this->successResponse(
                        'مفيش تصنيفات موجودة حالياً.'
                    );
                }

                $response = "🏷️ التصنيفات:\n\n";

                foreach (
                    $categories as $index => $category
                ) {
                    $response .=
                        ($index + 1) .
                        ". " .
                        $category->name .
                        " — " .
                        $category->meals_count .
                        " وجبة\n";
                }

                return $this->successResponse(
                    trim($response)
                );
            }

            /*
            |--------------------------------------------------------------------------
            | General Dashboard Statistics
            |--------------------------------------------------------------------------
            */

            if ($this->containsAny($text, [
                'احصائيات',
                'إحصائيات',
                'ملخص المطعم',
                'ملخص',
                'dashboard',
                'الداشبورد',
                'حاله المطعم',
                'حالة المطعم',
            ])) {
                $customers = User::where(
                    'role',
                    'user'
                )->count();

                $meals = Meal::count();

                $availableMeals = Meal::where(
                    'is_available',
                    true
                )->count();

                $categories = Category::count();

                $orders = Order::count();

                $pending = Order::where(
                    'status',
                    'pending'
                )->count();

                $delivered = Order::where(
                    'status',
                    'delivered'
                )->count();

                $sales = Order::where(
                    'status',
                    'delivered'
                )->sum('total');

                $sales = number_format(
                    (float) $sales,
                    2
                );

                return $this->successResponse(
                    "📊 ملخص المطعم:\n\n" .
                    "👥 العملاء: {$customers}\n" .
                    "🍔 الوجبات: {$meals}\n" .
                    "✅ الوجبات المتاحة: {$availableMeals}\n" .
                    "🏷️ التصنيفات: {$categories}\n" .
                    "📦 إجمالي الطلبات: {$orders}\n" .
                    "⏳ الطلبات المعلقة: {$pending}\n" .
                    "🎉 الطلبات المكتملة: {$delivered}\n" .
                    "💰 إجمالي المبيعات: {$sales} جنيه"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Direct Meal Search
            |--------------------------------------------------------------------------
            */

            $directMeal = $this->findDirectMeal(
                $message
            );

            if ($directMeal) {
                $price = number_format(
                    (float) $directMeal->active_price,
                    2
                );

                $response =
                    "🍔 الوجبة: {$directMeal->name}\n\n" .
                    "💰 السعر: {$price} جنيه\n" .
                    "⭐ التقييم: " .
                    ($directMeal->rating ?? 'لا يوجد') .
                    "\n" .
                    "📦 متاحة: " .
                    ($directMeal->is_available
                        ? 'نعم'
                        : 'لا');

                if ($directMeal->category) {
                    $response .=
                        "\n🏷️ التصنيف: " .
                        $directMeal->category->name;
                }

                if ($directMeal->description) {
                    $response .=
                        "\n📝 الوصف: " .
                        $directMeal->description;
                }

                return $this->successResponse(
                    $response
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Food Filters
            |--------------------------------------------------------------------------
            */

            $filters = $this->detectFoodFilters(
                $text
            );

            if (!empty($filters)) {
                $query = Meal::with('category')
                    ->where(
                        'is_available',
                        true
                    );

                foreach (
                    $filters as $column => $value
                ) {
                    if ($value === true) {
                        $query->where(
                            $column,
                            true
                        );
                    }
                }

                $meals = $query
                    ->orderByDesc('rating')
                    ->limit(20)
                    ->get();

                $filterNames = $this->filterNames(
                    $filters
                );

                $title =
                    '🍔 الوجبات التي تناسب طلبك';

                if (!empty($filterNames)) {
                    $title .=
                        ' (' .
                        implode(
                            ' + ',
                            $filterNames
                        ) .
                        ')';
                }

                return $this->successResponse(
                    $this->formatMealsResponse(
                        $meals,
                        $title
                    )
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Default Response
            |--------------------------------------------------------------------------
            */

            return $this->successResponse(
                "أنا أقدر أجيبلك بيانات المطعم من قاعدة البيانات مباشرة 😊\n\n" .
                "جربي مثلاً:\n" .
                "• عدد العملاء\n" .
                "• عدد الأوردرات\n" .
                "• عدد الطلبات المعلقة\n" .
                "• إجمالي المبيعات\n" .
                "• مبيعات الشهر\n" .
                "• أكثر الوجبات مبيعاً\n" .
                "• عدد الوجبات\n" .
                "• الوجبات المتاحة\n" .
                "• الوجبات المخفضة\n" .
                "• أرخص وجبة\n" .
                "• عدد التصنيفات\n" .
                "• اعرض التصنيفات\n" .
                "• بيانات العميل أحمد"
            );

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' =>
                    "حصل خطأ داخل Laravel:\n\n" .
                    $e->getMessage() .
                    "\n\nالملف:\n" .
                    $e->getFile() .
                    "\n\nالسطر:\n" .
                    $e->getLine(),
            ], 500);
        }
    }

    private function successResponse(string $message)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    private function normalizeText(string $text): string
    {
        $text = mb_strtolower(
            trim($text),
            'UTF-8'
        );

        return str_replace(
            [
                'أ',
                'إ',
                'آ',
                'ة',
                'ى',
                'ؤ',
                'ئ',
            ],
            [
                'ا',
                'ا',
                'ا',
                'ه',
                'ي',
                'و',
                'ي',
            ],
            $text
        );
    }

    private function containsAny(
        string $text,
        array $words
    ): bool {
        foreach ($words as $word) {
            $word = $this->normalizeText($word);

            if (
                $word !== '' &&
                mb_strpos(
                    $text,
                    $word
                ) !== false
            ) {
                return true;
            }
        }

        return false;
    }

    private function findCustomer(
        string $message
    ): ?User {
        $text = $this->normalizeText(
            $message
        );

        $customers = User::where(
            'role',
            'user'
        )->get();

        foreach ($customers as $customer) {
            $name = $this->normalizeText(
                $customer->name
            );

            if (
                $name !== '' &&
                mb_strpos(
                    $text,
                    $name
                ) !== false
            ) {
                return $customer;
            }
        }

        return null;
    }

    private function findDirectMeal(
        string $message
    ): ?Meal {
        $text = $this->normalizeText(
            $message
        );

        $meals = Meal::with(
            'category'
        )->get();

        foreach ($meals as $meal) {
            $mealName = $this->normalizeText(
                $meal->name
            );

            if (
                $mealName !== '' &&
                mb_strpos(
                    $text,
                    $mealName
                ) !== false
            ) {
                return $meal;
            }
        }

        return null;
    }

    private function detectFoodFilters(
        string $text
    ): array {
        $filters = [];

        if ($this->containsAny($text, [
            'سبايسي',
            'حار',
            'حاره',
            'حراق',
            'spicy',
        ])) {
            $filters['is_spicy'] = true;
        }

        if ($this->containsAny($text, [
            'فراخ',
            'دجاج',
            'chicken',
        ])) {
            $filters['has_chicken'] = true;
        }

        if ($this->containsAny($text, [
            'جبنه',
            'جبن',
            'cheese',
        ])) {
            $filters['has_cheese'] = true;
        }

        if ($this->containsAny($text, [
            'لحمه',
            'لحم',
            'meat',
        ])) {
            $filters['has_meat'] = true;
        }

        if ($this->containsAny($text, [
            'مشروم',
            'فطر',
            'mushroom',
        ])) {
            $filters['has_mushroom'] = true;
        }

        if ($this->containsAny($text, [
            'نباتي',
            'نباتيه',
            'vegetarian',
        ])) {
            $filters['is_vegetarian'] = true;
        }

        if ($this->containsAny($text, [
            'صحي',
            'صحيه',
            'دايت',
            'دايته',
            'healthy',
            'diet',
        ])) {
            $filters['is_healthy'] = true;
        }

        if ($this->containsAny($text, [
            'فيجان',
            'vegan',
            'نباتي صرف',
        ])) {
            $filters['is_vegan'] = true;
        }

        if ($this->containsAny($text, [
            'خالي من الجلوتين',
            'خالي من الجلوتن',
            'gluten free',
        ])) {
            $filters['is_gluten_free'] = true;
        }

        if ($this->containsAny($text, [
            'خالي من منتجات الالبان',
            'خالي من الالبان',
            'dairy free',
        ])) {
            $filters['is_dairy_free'] = true;
        }

        if ($this->containsAny($text, [
            'بروتين عالي',
            'بروتين عالى',
            'high protein',
        ])) {
            $filters['is_high_protein'] = true;
        }

        if ($this->containsAny($text, [
            'قليل السعرات',
            'قليله السعرات',
            'منخفض السعرات',
            'low calorie',
        ])) {
            $filters['is_low_calorie'] = true;
        }

        return $filters;
    }

    private function filterNames(
        array $filters
    ): array {
        $names = [];

        $map = [
            'is_spicy' => 'حارة / سبايسي',
            'has_chicken' => 'فراخ',
            'has_cheese' => 'جبنة',
            'has_meat' => 'لحمة',
            'has_mushroom' => 'مشروم',
            'is_vegetarian' => 'نباتية',
            'is_healthy' => 'صحية',
            'is_vegan' => 'Vegan',
            'is_gluten_free' => 'خالية من الجلوتين',
            'is_dairy_free' => 'خالية من الألبان',
            'is_high_protein' => 'بروتين عالي',
            'is_low_calorie' => 'قليلة السعرات',
        ];

        foreach (
            $filters as $key => $value
        ) {
            if (
                $value &&
                isset($map[$key])
            ) {
                $names[] = $map[$key];
            }
        }

        return $names;
    }

    private function formatMealsResponse(
        $meals,
        string $title
    ): string {
        if ($meals->isEmpty()) {
            return 'مفيش وجبات مطابقة لطلبك حالياً.';
        }

        $response =
            $title .
            ":\n\n";

        foreach (
            $meals as $index => $meal
        ) {
            $price = number_format(
                (float) $meal->active_price,
                2
            );

            $response .=
                ($index + 1) .
                '. ' .
                $meal->name .
                ' — ' .
                $price .
                ' جنيه';

            if ($meal->has_discount) {
                $response .=
                    ' 🔥 خصم ' .
                    $meal->discount_percentage .
                    '%';
            }

            if ($meal->category) {
                $response .=
                    ' — ' .
                    $meal->category->name;
            }

            if (
                $meal->rating !== null &&
                $meal->rating > 0
            ) {
                $response .=
                    "\n   ⭐ التقييم: " .
                    $meal->rating .
                    '/5';
            }

            $response .= "\n";
        }

        return trim($response);
    }

    private function helpResponse(): string
    {
        return
            "🤖 أقدر أجيبلك البيانات من قاعدة بيانات المطعم مباشرة.\n\n" .

            "👥 العملاء:\n" .
            "• عدد العملاء\n" .
            "• بيانات العميل أحمد\n\n" .

            "📦 الطلبات:\n" .
            "• عدد الأوردرات\n" .
            "• عدد الطلبات المعلقة\n" .
            "• عدد الطلبات المؤكدة\n" .
            "• عدد الطلبات قيد التحضير\n" .
            "• عدد الطلبات الجاهزة\n" .
            "• عدد الطلبات المكتملة\n" .
            "• عدد الطلبات الملغاة\n\n" .

            "💰 المبيعات:\n" .
            "• إجمالي المبيعات\n" .
            "• مبيعات الشهر\n" .
            "• مبيعات السنة\n\n" .

            "🔥 الوجبات:\n" .
            "• أكثر الوجبات مبيعاً\n" .
            "• عدد الوجبات\n" .
            "• الوجبات المتاحة\n" .
            "• الوجبات المخفضة\n" .
            "• أرخص وجبة\n" .
            "• أغلى وجبة\n\n" .

            "🏷️ التصنيفات:\n" .
            "• عدد التصنيفات\n" .
            "• اعرض التصنيفات\n\n" .

            "🌶️ البحث في الوجبات:\n" .
            "• هاتلي الوجبات الحارة\n" .
            "• هاتلي وجبات فيها فراخ\n" .
            "• هاتلي وجبات فيها جبنة وفراخ\n" .
            "• هاتلي وجبات نباتية\n" .
            "• هاتلي وجبات صحية\n" .
            "• هاتلي وجبات قليلة السعرات";
    }
}