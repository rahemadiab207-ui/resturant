@extends('layout.app')

@section('content')
<div class="text-center py-2 mb-2 bg-custom-black text-white rounded">
    <h3 class="fw-bold text-custom-yellow mb-1" style="font-size: 1.4rem;">أهلاً بكم في مطعم شاورما الشامي 🌯</h3>
    <p class="small text-muted mb-0" style="font-size: 0.85rem; line-height: 1.2;">أشهى الوجبات والسندوتشات الشامية بالطعم الأصلي</p>
</div>
<div class="text-center mb-3">
    <h5 class="fw-bold border-bottom border-warning border-2 d-inline-block pb-1 text-custom-yellow" style="font-size: 1.1rem;">
        جميع الوجبات
    </h5>
</div>

<div class="row">

<h5>class="fw-bold  border-bottom border-warning border-2 d-inline-block pb-1 text-custom-yellow">قائمة الوجبات</h5>

<img src="{{ asset('images/logo.png') }}" alt="لوجو المطعم" style="max-width: 150px; height: auto;">

<div class="row">
    @foreach($meals as $meal)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $meal->name }}">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title fw-bold">{{ $meal->name }}</h5>
                    <p class="card-text text-muted small">{{ $meal->description }}</p>
                </div>
                <div class="d-flex flex-column mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if(isset($meal->discount) && $meal->discount > 0)
                               <!-- السعر بعد حساب نسبة الخصم -->
                        <span class="fs-5 fw-bold text-danger">
                            {{ $meal->price - ($meal->price * $meal->discount / 100) }} ج.م
                             </span>
                                       <!-- السعر القديم مشطوب -->
                                     <del class="text-muted small">{{ $meal->price }} ج.م</del>
                                              @else
                                         <!-- السعر العادي إذا لم يوجد خصم -->
                                             <span class="fs-5 fw-bold text-dark">{{ $meal->price }} ج.م</span>
                                   @endif
                    </div>
                    
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
@endsection