@extends('layout.app')
@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-3">
        
        <div class="text-center mb-4">
            <h1 class="fw-bold text-warning">{{ $category->name ?? 'جميع الوجبات' }}</h1>
            <p class="text-muted">
                {{ isset($category) ? 'استمتع بأشهى وجبات قسم ' . $category->name . ' الطازجة' : 'استمتع بأشهى الوجبات الطازجة من مطعمنا' }}
            </p>
        </div>

        <!-- قائمة الوجبات -->
        <div class="row g-4">
            @foreach($meals as $meal)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-3">
            <!-- صورة الوجبة -->
            <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" style="height: 300px; object-fit: cover;" alt="{{ $meal->name }}">
            
            <div class="card-body d-flex flex-column justify-content-between h-100">
    <div>
        <h5 class="card-title fw-bold">{{ $meal->name }}</h5>
        <p class="card-text text-muted small mb-3">{{ $meal->description }}</p>
    </div>

    <div>
     @php
    // التحقق من وجود قيمة خصم صالحة وأكبر من الصفر
    $discountVal = $meal->discount_price ?? 0;
    $hasDiscount = $discountVal > 0;
    // حساب السعر النهائي بعد طرح الخصم من السعر الأساسي
    $finalPrice = $meal->price - $discountVal;
@endphp

<!-- قسم الأسعار -->
<div class="mb-3 text-end">
    @if($hasDiscount)
        <!-- السعر الأساسي القديم مشطوب في الأعلى -->
        <div class="text-muted text-decoration-line-through small" style="font-size: 13px;">
            {{ number_format($meal->price, 2) }} ج.م
        </div>
        <!-- السعر الجديد بعد الخصم تحته مباشرة -->
        <div class="text-danger fw-bold fs-5">
            {{ number_format($finalPrice, 2) }} ج.م
        </div>
    @else
        <!-- لو مفيش خصم، اعرض السعر الأساسي فقط -->
        <div class="text-dark fw-bold fs-5">
            {{ number_format($meal->price, 2) }} ج.م
        </div>
    @endif
</div>
       

        <!-- زر الإضافة للسلة -->
        <form action="{{ route('cart.add', $meal->id) }}" method="POST">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="btn btn-warning w-100 fw-bold">
                <i class="fa-solid fa-cart-plus me-1"></i> إضافة للسلة
            </button>
        </form>
    </div>
</div>
        </div>
    </div>
@endforeach
        </div>
        
    </div>
@endsection
</body>
</html>