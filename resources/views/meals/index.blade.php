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
            
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title fw-bold text-center mb-2">{{ $meal->name }}</h5>
                    <!-- إرجاع وصف الوجبة -->
                    <p class="card-text text-muted text-lift small mb-3">{{ $meal->description }}</p>
                </div>

                <!-- الجزء السفلي: السعر وزر الإضافة -->
                <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                    @if($meal->is_on_sale && $meal->discount_price)
                        <span class="fs-5 fw-bold text-danger">{{ $meal->discount_price }} ج.م</span>
                    @else
                        <span class="fs-5 fw-bold text-dark">{{ $meal->price }} ج.م</span>
                    @endif
                    
                    <!-- نموذج إضافة للسلة بتنسيق مدمج -->
                    <form action="{{ route('cart.add', $meal->id) }}" method="POST" class="d-inline m-0 p-0">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-warning btn-sm px-3 fw-bold">
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