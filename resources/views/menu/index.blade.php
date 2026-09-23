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
                        <div class="card h-100 shadow-sm border-0 rounded-3 position-relative">
                            {{-- شارة الخصم إن وجد --}}
                            @if($hasDiscount)
                                <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded-2 fw-bold small">
                                    خصم {{ $meal->discount ?? '' }}%
                                </span>
                            @endif

                            @if($meal->image)
                                <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" alt="{{ $meal->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=500" class="card-img-top" alt="{{ $meal->name }}" style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold">{{ $meal->name }}</h5>
                                    <p class="card-text text-muted small">{{ $meal->description }}</p>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- عرض الأسعار (قبل وبعد الخصم) --}}
                                    <div>
                                        @if($hasDiscount)
                                            <span class="text-decoration-line-through text-muted me-1 small">{{ number_format($meal->price, 2) }} ج.م</span>
                                            <span class="fw-bold text-black fs-5">{{ number_format($finalPrice, 2) }} ج.م</span>
                                        @else
                                            <span class="fw-bold text-black fs-5">{{ number_format($meal->price, 2) }} ج.م</span>
                                        @endif
                                    </div>
                                    
                                    <!-- زر الإضافة للسلة -->
                                    <form action="{{ route('cart.add', $meal->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center" style="width: 55px;">
                                        <button type="submit" class="btn btn-warning btn-sm fw-bold text-white">
                                            <i class="fa-solid fa-cart-plus me-1"></i> أضف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted fst-italic">لا توجد وجبات مضافة في هذا القسم حالياً.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="alert alert-warning d-inline-block px-5">لم يتم العثور على القسم المطلوب.</div>
        </div>
    @endif

</div>
@endsection