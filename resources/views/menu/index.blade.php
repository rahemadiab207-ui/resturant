@extends('layout.app')

@section('content')
<div class="container py-4">

    @if(isset($category))
        <div class="mb-5">
            <!-- عنوان القسم المختار فقط -->
            <div class="d-flex align-items-center mb-4 border-bottom pb-2">
                <h2 class="fw-bold text-dark m-0">
                    <i class="fa-solid fa-utensils text-warning me-2"></i>{{ $category->name }}
                </h2>
            </div>

            <!-- عرض وجبات هذا القسم فقط -->
            <div class="row g-4">
                @forelse($category->meals as $meal)
                    @php
                        // حساب السعر النهائي بعد الخصم
                        $finalPrice = $meal->price;
                        $hasDiscount = false;

                        if (isset($meal->discount_price) && $meal->discount_price > 0) {
                            $finalPrice = $meal->discount_price;
                            $hasDiscount = true;
                        } elseif (isset($meal->discount) && $meal->discount > 0) {
                            $finalPrice = $meal->price - ($meal->price * ($meal->discount / 100));
                            $hasDiscount = true;
                        }
                    @endphp

                   <div class="col-md-4">
    <div class="card h-100 shadow-sm border-0 rounded-3 position-relative" style="display: block !important;">
        {{-- شارة الخصم إن وجد --}}
        @if($hasDiscount)
            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded-2 fw-bold small" style="z-index: 10;">
                خصم {{ $meal->discount ?? '' }}%
            </span>
        @endif

        @if($meal->image)
            <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" alt="{{ $meal->name }}" style="height: 200px; object-fit: cover; width: 100%;">
        @else
            <img src="https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=500" class="card-img-top" alt="{{ $meal->name }}" style="height: 200px; object-fit: cover; width: 100%;">
        @endif

       <div class="card-body" style="display: block !important; text-align: right !important; padding: 15px !important;">
    
    <!-- اسم ووصف الوجبة -->
    <div style="margin-bottom: 15px !important;">
        <h5 class="card-title fw-bold" style="color: #fff !important; margin-bottom: 5px;">{{ $meal->name }}</h5>
        <p class="card-text text-muted small" style="margin-bottom: 0;">{{ $meal->description }}</p>
    </div>

    <!-- السعر القديم (إن وجد) -->
    @if($hasDiscount)
        <div style="margin-bottom: 3px !important;">
            <span style="text-decoration: line-through !important; color: #aaa !important; font-size: 13px !important;">
                {{ number_format($meal->price, 2) }} ج.م
            </span>
        </div>
        <!-- السعر الجديد -->
        <div style="margin-bottom: 12px !important;">
            <span style="color: #ff6b6b !important; font-weight: bold !important; font-size: 18px !important;">
                {{ number_format($finalPrice, 2) }} ج.م
            </span>
        </div>
    @else
        <!-- السعر العادي -->
        <div style="margin-bottom: 12px !important;">
            <span style="font-weight: bold !important; color: #fff !important; font-size: 18px !important;">
                {{ number_format($meal->price, 2) }} ج.م
            </span>
        </div>
    @endif

    <!-- زر إضافة للسلة -->
    <div style="width: 100% !important; clear: both !important;">
        <form action="{{ route('cart.add', $meal->id) }}" method="POST" style="width: 100% !important; margin: 0 !important;">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="btn btn-warning w-100 fw-bold" style="width: 100% !important;">
                <i class="fa-solid fa-cart-plus me-1"></i> إضافة للسلة
            </button>
        </form>
    </div>

</div>